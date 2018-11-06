<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Controllers\AuthController;
use Request;
use stdClass;
use Input;
use DateTime;
use Redirect;
use Session;
use Carbon\Carbon;
use App\Models\Tbl_advisor_votes;
use App\Models\Tbl_ambassador_votes;
use App\Models\Tbl_approved_candidates;
use App\Models\Tbl_global_board_of_directors_votes;
use App\Models\Tbl_positions;
use App\Models\Tbl_regional_board_of_directors_votes;
use App\Models\Tbl_user_voting_status;
use App\Models\Tbl_voting_user;
use App\Models\Tbl_applied_position;
use App\Globals\Login;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Facade;
use Toastr;
use Illuminate\Support\Facades\Mail;
use Excel;
use Config;
class AdminController extends AuthController
{
//
	public function admin()
	{
		$user = Tbl_voting_user::where("user_id", Session::get('session'))->first();

		if(isset($user))
		{
			if($user->user_type != 1)
			{
				return Redirect::to('/login')->send();
			}
			else
			{	
				$data['global_candidate']     = Tbl_voting_user::JoinUser()->where("tbl_applied_position.position_id",1)->get();
				$data['regional_candidate']   = Tbl_voting_user::JoinUser()->where("tbl_applied_position.position_id",2)->get();
				$data['ambassador_candidate'] = Tbl_voting_user::JoinUser()->where("tbl_applied_position.position_id",3)->orderBy('user_region','ASC')->get();
				$data['advisor_candidate']    = Tbl_voting_user::JoinUser()->where("tbl_applied_position.position_id",4)->get();
				//yung nsa loob ng bracket yan ang variable name na ttwagin mo dun sa html page mo.
				$data["usertype"]= $user->user_type;
				$data["fname"] = $user->user_first_name;
				$data["lname"] = $user->user_last_name;
				$data["pic"] = $user->user_picture;
				return view('admin.admin',$data);
			}
		}
		else
		{
			return Redirect::to('/login')->send();
		}
	}

	public function send_test_email()
	{
		 $data["mail_to"]       = "johnkenneth.delara@gmail.com";
		 $data['mail_username'] = Config::get('mail.username');
		 $data["subject"]       = "Testing testing";
		 $data["first_name"]    = "Digima B. House";
		 $data["from"]          = env('MAIL_USERNAME');

	 	 Mail::send('update_template', $data, function ($m) use ($data) 
         {
                $m->from($data["from"]);
                $m->to($data["mail_to"])->subject($data["subject"]);
         });
	}

	public function send_updates()
	{
		 $voters = Tbl_voting_user::where('user_type',0)->get();

		 foreach($voters as $voter)
		 {
		 	 $data = array();
			 $data["mail_to"]       = $voter->user_email;
			 $data['mail_username'] = Config::get('mail.username');
			 $data["subject"]       = "GABC Status Update";
			 $data["first_name"]    = $voter->user_first_name;
			 $data["from"]          = env('MAIL_USERNAME');

		 	 Mail::send('update_template', $data, function ($m) use ($data) 
	         {
	                $m->from($data["from"]);
	                $m->to($data["mail_to"])->subject($data["subject"]);
	         });
		 }

		Toastr::success("approved");
		return Redirect::to("/admin");
	}

	public function send_password()
	{	

		 $voters = Tbl_voting_user::where('user_type',0)->get();

		 foreach($voters as $voter)
		 {
		 	 $data = array();
			 $data["mail_to"]       = $voter->user_email;
			 $data['mail_username'] = Config::get('mail.username');
			 $data["subject"]       = "GABC Online Voting Log-In Account";
			 $data["first_name"]    = $voter->user_first_name;
			 $data["username"]      = $voter->user_name;
			 $data["password"]      = Self::generateRandomString();
			 $data["from"]          = env('MAIL_USERNAME');

		 	 Mail::send('password_template', $data, function ($m) use ($data) 
	         {
	                $m->from($data["from"]);
	                $m->to($data["mail_to"])->subject($data["subject"]);
	         });

	         $updatepass["user_password"] = $data["password"];
	         Tbl_voting_user::where('user_id',$voter->user_id)->update($updatepass);
		 }

		 
		Toastr::success("approved");
		return Redirect::to("/admin");

	}

	public static function generateRandomString($length = 25) 
	{

  	  return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
	}

	public function getcandidateinfo()
	{
		$user_id           = Request::Input('candidate_id');
		$data['candidate'] = Tbl_voting_user::where('user_id',$user_id)->first();
		$data['divname']   = Request::Input('position');
		return view('admin.approved_candidate',$data);
	}

	public function submit_votes()
	{   // dito irerequest mo ung mga input = $_post
		$globaldirectors   = Request::Input('globaldirectors');
		$regionaldirectors = Request::Input('regionaldirectors');
		$ambassadors       = Request::Input('ambassadors');
		$advisors          = Request::Input('advisors');

		//dahil array ang kinukuha mo kailngan mong iloop
		//
		foreach ($globaldirectors as $global)
		{
			$insert['user_id']     = $global;
			$insert['position_id'] = 1;
			Tbl_approved_candidates::insert($insert);
		}

		foreach ($regionaldirectors as $regional)
		{
			$insert['user_id']     = $regional;
			$insert['position_id'] = 2;
			Tbl_approved_candidates::insert($insert);
		}

		foreach ($ambassadors as $ambass)
		{
			$insert['user_id'] 	   = $ambass;
			$insert['position_id'] = 3;
			Tbl_approved_candidates::insert($insert);
		}

		foreach ($advisors as $advisors)
		{
			$insert['user_id']     = $advisors;
			$insert['position_id'] = 4;
			Tbl_approved_candidates::insert($insert);
		}

		Toastr::success("approved");
		return "sucess";
	}

	public static function getCountryByRegion($region)
	{
		switch ($region) 
		{
			case 'European Union':
				$region = "european_union";
				break;
			case 'Middle East':
				$region = "middle_east";
			break;
			case 'North America':
				$region = "north_america";
			break;
			case 'Africa':
				$region = "africa";
			break;
			case 'Asia':
				$region = "asia";
			break;
			case 'Oceania':
				$region = "oceania";
			break;
			case 'South America':
				$region = "south_america";
			break;
			case 'Eastern Europe':
				$region = "eastern_europe";
			break;
		}

		return $region;
	}
	public function import_template()
	{
		$file = Request::file('file');
		$_data = Excel::selectSheetsByIndex(0)->load($file, function($reader){})->all();

		foreach($_data as $data)
		{
			$positions = explode(",", $data["what_positions_are_you_applying_for"]);
			$insert["user_name"] = $data["preferred_username"];
			$insert["user_email"] = $data["email_address"];
			$insert["user_password"] = $data["last_name"];
			$insert["user_picture"] = $data["upload_professional_picture"];
			$insert["user_linked_in"] = $data["linkedin_profile_link"];
			$insert["user_media_linked"] = $data["media_links_that_youre_featured_in"];
			$insert["user_resume"] = $data["upload_resume_or_biography"];
			$insert["user_country"] = $data[Self::getCountryByRegion($data["region"])];
			$insert["user_region"] = $data["region"];
			$insert["user_first_name"] = $data["first_name"];
			$insert["user_middle_name"] = $data['middle_name'];
			$insert["user_last_name"] = $data["last_name"];
			$insert["user_company_name"] = $data["your_companys_name"];
			$user_id = Tbl_voting_user::insertGetId($insert);
			$count = 1;

			foreach ($positions as $pos)
			{
				$pos = $count == 2 ? ltrim($pos) : $pos;
				$position_id = Tbl_positions::where('position_name',$pos)->value('position_id');
				$insert_pos["user_id"] = $user_id;
				$insert_pos["position_id"] = $position_id;
				Tbl_applied_position::insert($insert_pos);

				$insert_approve['user_id']     = $user_id;
				$insert_approve['position_id'] = $position_id;
				Tbl_approved_candidates::insert($insert_approve);
				$count++;
			}

			$insert_status["user_id"]       = $user_id;
			$insert_status["voting_status"] = "Pending";
			Tbl_user_voting_status::insert($insert_status);
		}
		Toastr::success("approved");
		return Redirect::to("/admin");
	}
	
}

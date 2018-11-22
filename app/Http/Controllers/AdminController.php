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
use DB;
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

				$data["voting_status_pending"]        = Tbl_voting_user::leftjoin('tbl_user_voting_status','tbl_voting_user.user_id','=','tbl_user_voting_status.user_id')->where('tbl_voting_user.user_type','!=',1)->where('tbl_user_voting_status.voting_status',"Pending")->get();

				$data["voting_status_completed"]        = Tbl_voting_user::leftjoin('tbl_user_voting_status','tbl_voting_user.user_id','=','tbl_user_voting_status.user_id')->where('tbl_voting_user.user_type','!=',1)->where('tbl_user_voting_status.voting_status',"Completed")->get();

				$data["usertype"]= $user->user_type;
				$data["fname"] = $user->user_first_name;
				$data["lname"] = $user->user_last_name;
				$data["pic"] = $user->user_picture;
			
				$user_votes_list = array();

				foreach ($data["voting_status_completed"] as $value) 
				{
					if(!isset($user_votes_list[$value->user_first_name.' '.$value->user_last_name]))
					{
						//board
						$board = Tbl_global_board_of_directors_votes::GetVotesUser($value->user_id)->first();
						$user_votes_list[$value->user_first_name.' '.$value->user_last_name]["board"] = $board["user_first_name"]." ".$board["user_last_name"];
						//global
						$global = Tbl_regional_board_of_directors_votes::GetVotesUser($value->user_id)->first();
						$user_votes_list[$value->user_first_name.' '.$value->user_last_name]["global"] = $global["user_first_name"]." ".$global["user_last_name"];
						//regional
						$regional = Tbl_ambassador_votes::GetVotesUser($value->user_id)->first();
						$user_votes_list[$value->user_first_name.' '.$value->user_last_name]["regional"] = $regional["user_first_name"]." ".$regional["user_last_name"];
						//ambassador
						$ambassador = Tbl_advisor_votes::GetVotesUser($value->user_id)->first();
						$user_votes_list[$value->user_first_name.' '.$value->user_last_name]["ambassador"] = $ambassador["user_first_name"]." ".$ambassador["user_last_name"];
					}
				}

				$data["list_of_votes"] = $user_votes_list;
				
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
		 $data["mail_to"]       = "jesgonzales8@gmail.com";
		 $data['mail_username'] = Config::get('mail.username');
		 $data["subject"]       = "Testing testing";
		 $data["first_name"]    = "Digima B. House";
		 $data["from"]          = env('MAIL_USERNAME');
		 $data["username"]      = "John Kenneth Pogi de Lara";
		 $data["password"]      = "pogi123";

	 	 Mail::send('updatev4_template', $data, function ($m) use ($data) 
         {
                $m->from("johnkenneth.delara@gmail.com");
                $m->to($data["mail_to"])->subject($data["subject"]);
         });
	}

	public function import_v2()
	{
		$file = Request::file('file');
		$_data = Excel::selectSheetsByIndex(0)->load($file, function($reader){})->all();

		foreach($_data as $data)
		{
			if($data["email_address"] != "")
			{
				$insert["user_email"]        = $data["email_address"];
				$insert["user_password"]     = $data["first_name"];
				$insert["user_name"]         = $data["preferred_username"];
				$insert["user_first_name"]   = $data["first_name"];
				$insert["user_last_name"]    = $data["last_name"];
				$insert["user_picture"]      = "assets/images/";
				$insert["user_linked_in"]    = "";
				$insert["user_media_linked"] = "";
				$insert["user_resume"]       = "";
				$insert["user_country"]      = "";
				$insert["user_region"]       = "";
				$insert["user_type"]         = 3;

				$user_id = Tbl_voting_user::insertGetId($insert);

				$insert_status["user_id"]       = $user_id;
				$insert_status["voting_status"] = "Pending";

				Tbl_user_voting_status::insert($insert_status);
			}

		}

		Toastr::success("approved");
		return Redirect::to("/admin");
	}

	public function send_password_v2()
	{
		 $voters = Tbl_voting_user::where('user_type',3)->get();

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


	public function send_updates_v2()
	{
		$voters = Tbl_voting_user::where('user_type',3)->get();

		 foreach($voters as $voter)
		 {
		 	 $data = array();
			 $data["mail_to"]       = $voter->user_email;
			 $data['mail_username'] = Config::get('mail.username');
			 $data["subject"]       = "GABC-ONLINE ELECTION UPDATES";
			 $data["first_name"]    = $voter->user_first_name;
			 $data["from"]          = env('MAIL_USERNAME');

		 	 Mail::send('updatev2_template', $data, function ($m) use ($data) 
	         {
	                $m->from($data["from"]);
	                $m->to($data["mail_to"])->subject($data["subject"]);
	         });
		 }

		Toastr::success("approved");
		return Redirect::to("/admin");
	}

	public function send_updates_v4()
	{
		$pending        = Tbl_voting_user::leftjoin('tbl_user_voting_status','tbl_voting_user.user_id','=','tbl_user_voting_status.user_id')->where('tbl_voting_user.user_type','!=',1)->where('tbl_user_voting_status.voting_status',"Pending")->get();

		foreach($pending as $voter)
		{
			 $data = array();
			 $data["mail_to"]       = $voter->user_email;
			 $data['mail_username'] = Config::get('mail.username');
			 $data["subject"]       = "GABC FOLLOW UP VOTER'S ACCOUNT";
			 $data["first_name"]    = $voter->user_first_name;
			 $data["from"]          = env('MAIL_USERNAME');
			 $data["username"]      = $voter->user_name;
			 $data["password"]      = $voter->user_password;

		 	 Mail::send('updatev4_template', $data, function ($m) use ($data) 
	         {
	                $m->from($data["from"]);
	                $m->to($data["mail_to"])->subject($data["subject"]);
	         });
		}

		Toastr::success("approved");
		return Redirect::to("/admin");
	}

	public function send_updates_v3()
	{
		 $data["board"] = DB::table('tbl_global_board_of_directors_votes')
          ->select('tbl_global_board_of_directors_votes.approved_candidate_id', DB::raw('COUNT(*) as votes_count'), 'user_first_name','user_last_name','user_region','tbl_voting_user.user_id','tbl_voting_user.user_email')
          ->leftjoin('tbl_approved_candidates', 'tbl_global_board_of_directors_votes.approved_candidate_id', '=', 'tbl_approved_candidates.approved_candidate_id')
          ->leftjoin('tbl_voting_user','tbl_approved_candidates.user_id','=','tbl_voting_user.user_id')
          ->groupBy('approved_candidate_id')
          ->having('votes_count', '>' , 0)
          ->orderBy('votes_count','DESC')
          ->limit(5)
          ->get();

          $data["global"] = DB::table('tbl_regional_board_of_directors_votes')
          ->select('tbl_regional_board_of_directors_votes.approved_candidate_id', DB::raw('COUNT(*) as votes_count'), 'user_first_name','user_last_name','user_region','tbl_voting_user.user_id','tbl_voting_user.user_email')
          ->leftjoin('tbl_approved_candidates', 'tbl_regional_board_of_directors_votes.approved_candidate_id', '=', 'tbl_approved_candidates.approved_candidate_id')
          ->leftjoin('tbl_voting_user','tbl_approved_candidates.user_id','=','tbl_voting_user.user_id')
          ->groupBy('approved_candidate_id')
          ->having('votes_count', '>' , 0)
          ->orderBy('votes_count','DESC')
          ->limit(10)
          ->get();

           $data["regional"] = DB::table('tbl_ambassador_votes')
          ->select('tbl_ambassador_votes.approved_candidate_id', DB::raw('COUNT(*) as votes_count'), 'user_first_name','user_last_name','user_region','tbl_voting_user.user_id','tbl_voting_user.user_email')
          ->leftjoin('tbl_approved_candidates', 'tbl_ambassador_votes.approved_candidate_id', '=', 'tbl_approved_candidates.approved_candidate_id')
          ->leftjoin('tbl_voting_user','tbl_approved_candidates.user_id','=','tbl_voting_user.user_id')
          ->groupBy('approved_candidate_id')
          ->having('votes_count', '>' , 0)
          ->orderBy('votes_count','DESC')
          ->limit(10)
          ->get();


          $data["ambas"] = DB::table('tbl_advisor_votes')
          ->select('tbl_advisor_votes.approved_candidate_id', DB::raw('COUNT(*) as votes_count'), 'user_first_name','user_last_name','user_region','user_country','tbl_voting_user.user_id','tbl_voting_user.user_email')
          ->leftjoin('tbl_approved_candidates', 'tbl_advisor_votes.approved_candidate_id', '=', 'tbl_approved_candidates.approved_candidate_id')
          ->leftjoin('tbl_voting_user','tbl_approved_candidates.user_id','=','tbl_voting_user.user_id')
          ->groupBy('approved_candidate_id')
          ->having('votes_count', '>' , 0)
          ->orderBy('votes_count','DESC')
          ->get();

          $data["ambas"]                     = Self::getAmbassadorVotes($data["ambas"]); 
          $final_data = Self::RemoveDuplicatePosition($data);


          $final_data["total_board_vote_count"]    = Self::total_vote_count($final_data["board"]);
          $final_data["total_global_vote_count"]   = Self::total_vote_count($final_data["global"]);
          $final_data["total_regional_vote_count"] = Self::total_vote_count($final_data["regional"]);
          $final_data["total_ambas_vote_count"]    = Self::getAmbassadorVotes($final_data["ambas"],true);


		 foreach($final_data["board"] as $key => $board)
		 {
		 	 $data = array();
			 $data["mail_to"]       = $board->user_email;
			 $data['mail_username'] = Config::get('mail.username');
			 $data["subject"]       = "GABC NEWLY ELECTED BOARD MEMBER";
			 $data["first_name"]    = $board->user_first_name;
			 $data["from"]          = env('MAIL_USERNAME');
			 $data["position"]      = "Board of Trustees";

		 	 Mail::send('updatev3_template', $data, function ($m) use ($data) 
	         {
	                $m->from($data["from"]);
	                $m->to($data["mail_to"])->subject($data["subject"]);
	         });
		 }

		 foreach($final_data["global"] as $key => $global)
		 {
		 	 $data = array();
			 $data["mail_to"]       = $global->user_email;
			 $data['mail_username'] = Config::get('mail.username');
			 $data["subject"]       = "GABC NEWLY ELECTED BOARD MEMBER";
			 $data["first_name"]    = $global->user_first_name;
			 $data["from"]          = env('MAIL_USERNAME');
			 $data["position"]      = "Global Board of Directors";

		 	 Mail::send('updatev3_template', $data, function ($m) use ($data) 
	         {
	                $m->from($data["from"]);
	                $m->to($data["mail_to"])->subject($data["subject"]);
	         });
		 }


		 foreach($final_data["regional"] as $key => $regional)
		 {
		 	 $data = array();
			 $data["mail_to"]       = $regional->user_email;
			 $data['mail_username'] = Config::get('mail.username');
			 $data["subject"]       = "GABC NEWLY ELECTED BOARD MEMBER";
			 $data["first_name"]    = $regional->user_first_name;
			 $data["from"]          = env('MAIL_USERNAME');
			 $data["position"]      = "Regional Board of Directors";

		 	 Mail::send('updatev3_template', $data, function ($m) use ($data) 
	         {
	                $m->from($data["from"]);
	                $m->to($data["mail_to"])->subject($data["subject"]);
	         });
		 }

		 foreach($final_data["ambas"] as $key => $ambas)
		 {
		 	 $data = array();
			 $data["mail_to"]       = $ambas->user_email;
			 $data['mail_username'] = Config::get('mail.username');
			 $data["subject"]       = "GABC NEWLY ELECTED BOARD MEMBER";
			 $data["first_name"]    = $ambas->user_first_name;
			 $data["from"]          = env('MAIL_USERNAME');
			 $data["position"]      = "Ambassador";

		 	 Mail::send('updatev3_template', $data, function ($m) use ($data) 
	         {
	                $m->from($data["from"]);
	                $m->to($data["mail_to"])->subject($data["subject"]);
	         });
		 }

		Toastr::success("approved");
		return Redirect::to("/admin");
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

	public static function total_vote_count($data)
    {
          //initialize array
          $rowboard = array();

          //loop the data
          foreach($data as $board)
          {
            //push to the array
            $rowboard[] = $board->votes_count;
          }

          //sum it beybeh
          $total = array_sum($rowboard);

         return $total;
    }

    public function RemoveDuplicatePosition($data)
    {
        //loop ambassadors
        foreach($data["ambas"] as $key => $ambassador)
        {
            //check the if ambassador is running on regional
            foreach($data["regional"] as $regional)
            {
                //if found on regional
                if($ambassador->user_first_name.' '.$ambassador->user_last_name == $regional->user_first_name.' '.$regional->user_last_name)
                {
                    //remove the ambassador 
                    unset($data["ambas"][$key]);
                    //get the second highest votes in ambassador 
                    if(count(Self::getAdvisorSecondHighest($ambassador->user_id,$ambassador->user_country)) != 0)
                    {
                         $data["ambas"][$key] = Self::getAdvisorSecondHighest($ambassador->user_id,$ambassador->user_country);
                    }
                }
            }

            foreach ($data["global"] as $global) 
            {
                if($ambassador->user_first_name.' '.$ambassador->user_last_name == $global->user_first_name.' '.$global->user_last_name)
                {
                    unset($data["ambas"][$key]);
                    if(count(Self::getAdvisorSecondHighest($ambassador->user_id,$ambassador->user_country)) != 0)
                    {
                         $data["ambas"][$key] = Self::getAdvisorSecondHighest($ambassador->user_id,$ambassador->user_country);
                    }
                }

            }

            foreach ($data["board"] as $board) 
            {
                if($ambassador->user_first_name.' '.$ambassador->user_last_name == $board->user_first_name.' '.$board->user_last_name)
                {
                    unset($data["ambas"][$key]);
                    if(count(Self::getAdvisorSecondHighest($ambassador->user_id,$ambassador->user_country)) != 0)
                    {
                         $data["ambas"][$key] = Self::getAdvisorSecondHighest($ambassador->user_id,$ambassador->user_country);
                    }
                }

            }

        }

        //initialize array for storing the existing candidate in regional
        $existing_candidate_regional = array();

        //loop regional
        foreach($data["regional"] as $key => $regional)
        {
            //check if regional is running on global
            foreach ($data["global"] as $global)  
            {
                //if found on global unset the regional
                if($regional->user_first_name.' '.$regional->user_last_name == $global->user_first_name.' '.$global->user_last_name)
                {   
                    unset($data["regional"][$key]);
                }

            }

            foreach ($data["board"] as $board) 
            {
                if($regional->user_first_name.' '.$regional->user_last_name == $board->user_first_name.' '.$board->user_last_name)
                {
                    unset($data["regional"][$key]);
                }

            }

            //push the user id to the array candidates
            $existing_candidate_regional[] = $regional->user_id;
        }

        //check if regional is less than to 5 (total seats)
        if(count($data["regional"]) < 5)
        {
          //get the avaailable vacant position in regional
          $limit = 5 - count($data["regional"]);
          //get the sub winner for regional
          $regionsub = Self::getRegionalSubWinner($existing_candidate_regional,$limit);
          //merge the sub winner to the regional winners
          $data["regional"] = $data["regional"]->merge($regionsub);
        }
        


        $existing_candidate_global = array();

        foreach ($data["global"] as $key => $global) 
        {
            foreach ($data["board"] as $board) 
            {
                if($global->user_first_name.' '.$global->user_last_name == $board->user_first_name.' '.$board->user_last_name)
                {
                    unset($data["global"][$key]);
                } 

            }

            $existing_candidate_global[] = $global->user_id;
        }

        if(count($data["global"]) < 10)
        {
          $limit2 = 10 - count($data["global"]);
          $globalsub = Self::getGlobalSubWinner($existing_candidate_global,$limit2);
          $data["global"] = $data["global"]->merge($globalsub);
        }

        return $data;

    }

    public static function getGlobalSubWinner($user_ids,$limit)
    {
       $global_sub_winner = DB::table('tbl_regional_board_of_directors_votes')
          ->select('tbl_regional_board_of_directors_votes.approved_candidate_id', DB::raw('COUNT(*) as votes_count'), 'user_first_name','user_last_name','user_region','tbl_voting_user.user_id')
          ->leftjoin('tbl_approved_candidates', 'tbl_regional_board_of_directors_votes.approved_candidate_id', '=', 'tbl_approved_candidates.approved_candidate_id')
          ->leftjoin('tbl_voting_user','tbl_approved_candidates.user_id','=','tbl_voting_user.user_id')
          ->groupBy('approved_candidate_id')
          ->whereNotIn('tbl_voting_user.user_id',$user_ids)
          ->having('votes_count', '>' , 0)
          ->orderBy('votes_count','DESC')
          ->limit($limit)
          ->get();

          return $global_sub_winner;
    }
    
    public static function getRegionalSubWinner($user_ids,$limit)
    {
        $regional_sub_winner = DB::table('tbl_ambassador_votes')
          ->select('tbl_ambassador_votes.approved_candidate_id', DB::raw('COUNT(*) as votes_count'), 'user_first_name','user_last_name','user_region','tbl_voting_user.user_id')
          ->leftjoin('tbl_approved_candidates', 'tbl_ambassador_votes.approved_candidate_id', '=', 'tbl_approved_candidates.approved_candidate_id')
          ->leftjoin('tbl_voting_user','tbl_approved_candidates.user_id','=','tbl_voting_user.user_id')
          ->groupBy('approved_candidate_id')
          ->whereNotIn('tbl_voting_user.user_id',$user_ids)
          ->having('votes_count', '>' , 0)
          ->orderBy('votes_count','DESC')
          ->limit($limit)
          ->get();

         return $regional_sub_winner;
    }

    public static function getAdvisorSecondHighest($user_id,$user_country)
    {
         $advisor_second_winner =  DB::table('tbl_advisor_votes')
          ->select('tbl_advisor_votes.approved_candidate_id', DB::raw('COUNT(*) as votes_count'), 'user_first_name','user_last_name','user_region','user_country','tbl_voting_user.user_id')
          ->leftjoin('tbl_approved_candidates', 'tbl_advisor_votes.approved_candidate_id', '=', 'tbl_approved_candidates.approved_candidate_id')
          ->leftjoin('tbl_voting_user','tbl_approved_candidates.user_id','=','tbl_voting_user.user_id')
          ->groupBy('approved_candidate_id')
          ->where('tbl_voting_user.user_id','!=',$user_id)
          ->where('tbl_voting_user.user_country',$user_country)
          ->having('votes_count', '>' , 0)
          ->orderBy('votes_count','DESC')
          ->limit(1)
          ->first();

          return $advisor_second_winner;
    }
    public static function getAmbassadorVotes($data,$totalvotes = false)
    {
      //initialize arrays
      $country           = array();
      $countrytotalvotes = array();

      foreach($data as $key => $ambas)
      { 
          //if not set, set it
          if(!isset($country[$ambas->user_country]))
          {
              $country[$ambas->user_country]                         = $ambas;
              //set total votes
              $countrytotalvotes[$ambas->user_country]["totalvotes"] = $ambas->votes_count;
          }
          //if candidates tied
          else if(isset($country[$ambas->user_country]) && $ambas->votes_count == $country[$ambas->user_country]->votes_count)
          {
              //push and set a different key for the country
              $country[$ambas->user_country.$key]                    = $ambas;
              $countrytotalvotes[$ambas->user_country]["totalvotes"] += $ambas->votes_count;
          }
          //if set
          else
          {
              //check if set candidates votes is less than to current loop candidate
              if($country[$ambas->user_country]->votes_count < $ambas->votes_count)
              {
                  //unset
                  unset($country[$ambas->user_country]);
                  //push
                  $country[$ambas->user_country] = $ambas;
              }

               $countrytotalvotes[$ambas->user_country]["totalvotes"] += $ambas->votes_count;

          }
      } 

      //if totalvotes is true return countrytotalvotes else country
      return $totalvotes == true ? $countrytotalvotes : $country;

    }
	
}

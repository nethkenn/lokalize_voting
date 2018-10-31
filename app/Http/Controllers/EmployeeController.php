<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\AuthVotersController;
use Request;
use stdClass;
use Input;
use DateTime;
use Session;
use Carbon\Carbon;
use Redirect;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Facade;

use App\Models\Tbl_advisor_votes;
use App\Models\Tbl_ambassador_votes;
use App\Models\Tbl_approved_candidates;
use App\Models\Tbl_global_board_of_directors_votes;
use App\Models\Tbl_positions;
use App\Models\Tbl_regional_board_of_directors_votes;
use App\Models\Tbl_user_voting_status;
use App\Models\Tbl_voting_user;
use App\Models\Tbl_user_votes;
use App\Models\Tbl_applied_position;


use App\Globals\Login;



class EmployeeController extends AuthVotersController
{

    
    // public static function active($sess)
    // {

    //   $user = Tbl_voting_user::where("user_id", $sess)->first();
      
    //     if($user->user_type == 0)
    //     {
    //         return Redirect::to('/employee')->send();
    //     }
    //     else if($user->user_type == 1)
    //     {
    //         return Redirect::to('/admin')->send();
    //     }
    //     else
    //     {
    //         return Redirect::to('/login')->send();
    //     }
    // }

    public function index()
    {
        $user = Tbl_voting_user::where("user_id", Session::get('session'))->first();

        if(isset($user))
        {
              if($user->user_type != 0)
              {
                  return Redirect::to('/login')->send();
              }
              else
              {   
                  $data['global_candidate']     = Tbl_approved_candidates::JoinUser()->where("position_id",1)->get();
                  $data['regional_candidate']   = Tbl_approved_candidates::JoinUser()->where("position_id",2)->get();
                  $data['ambassador_candidate'] = Tbl_approved_candidates::JoinUser()->where("position_id",3)->get();
                  $data['advisor_candidate']    = Tbl_approved_candidates::JoinUser()->where("position_id",4)->where("user_region",$user->user_region)->get();
                    // dd($data);
                  $data["fname"] = $user->user_first_name;
                  $data["lname"] = $user->user_last_name;
                  $data["pic"] = $user->user_picture;
                  $data["usertype"]= $user->user_type;
                  $data["user_id"] = $user->user_id;
                  $data["user_region"] = $user->user_region;

                  return view('voters.index',$data);

              }
        }
        else
        {
           return Redirect::to('/login')->send();
        }
    

    }

    public function getcandidateinfo()
    {
    	$user_id           = Request::Input('candidate_id');
    	$data['candidate'] = Tbl_voting_user::leftjoin('tbl_approved_candidates','tbl_voting_user.user_id','=','tbl_approved_candidates.user_id')->where('tbl_voting_user.user_id',$user_id)->first();
   		$data['divname']   = Request::Input('position');
        // dd($data);
    	return view('voters.voted_candidate',$data);
    }

    public function submit_votes()
    {

         // dito irerequest mo ung mga input = $_post
        $globaldirectors   = Request::Input('globaldirectors');
        $regionaldirectors = Request::Input('regionaldirectors');
        $ambassadors       = Request::Input('ambassadors');
        $advisors          = Request::Input('advisors');

        //dahil array ang kinukuha mo kailngan mong iloop
        //
        //---///
        $insert_user_id['user_id']                 = Request::Input('user_id');

        Tbl_user_votes::insert($insert_user_id);
  
        $update['voting_status']                   = "Completed"; 
        Tbl_user_voting_status::where('user_id',$insert_user_id['user_id'])->update($update);


        foreach ($globaldirectors as $global) 
        {
           $director['approved_candidate_id']      = Tbl_approved_candidates::where('user_id', $global)->value('approved_candidate_id');
           $director['user_id']                    = Request::Input('user_id');
           Tbl_global_board_of_directors_votes::insert($director);
          
        }
        foreach ($regionaldirectors as $regional) 
        {
           $regionalBoards['approved_candidate_id'] = Tbl_approved_candidates::where('user_id', $regional)->value('approved_candidate_id');
           $regionalBoards['user_id'] = Request::Input('user_id');
           Tbl_regional_board_of_directors_votes::insert($regionalBoards);
          
        }
        foreach ($ambassadors as $ambass) 
        {
           $ambassadorsList['approved_candidate_id'] = Tbl_approved_candidates::where('user_id', $ambass)->value('approved_candidate_id');
           $ambassadorsList['user_id']               = Request::Input('user_id');
           Tbl_ambassador_votes::insert($ambassadorsList);
          
        }
        foreach ($advisors as $advisor) 
        {
           $advisorlist['approved_candidate_id']     = Tbl_approved_candidates::where('user_id', $advisor)->value('approved_candidate_id');
           $advisorlist['user_id']                   = Request::Input('user_id');
           Tbl_advisor_votes::insert($advisorlist);
           
        }
        
        Session::start('session');
        Session::flush('session');
        return Redirect::to('/');
        
    }

}

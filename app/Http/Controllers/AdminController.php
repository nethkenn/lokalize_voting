<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

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
use App\Globals\Login;
use Excel;

class AdminController extends Controller
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
              
              $data['global_candidate']     = Tbl_voting_user::JoinUser()->where("user_applied_position",1)->get();
              $data['regional_candidate']   = Tbl_voting_user::JoinUser()->where("user_applied_position",2)->get();
              $data['ambassador_candidate'] = Tbl_voting_user::JoinUser()->where("user_applied_position",3)->orderBy('user_country','ASC')->get();
              $data['advisor_candidate']    = Tbl_voting_user::JoinUser()->where("user_applied_position",4)->get();

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
           $insert['user_id'] = $global;
           Tbl_approved_candidates::insert($insert);
        }

           foreach ($regionaldirectors as $regional) 
        {
           $insert['user_id'] = $regional;
           Tbl_approved_candidates::insert($insert);
        }

           foreach ($ambassadors as $ambass) 
        {
           $insert['user_id'] = $ambass;
           Tbl_approved_candidates::insert($insert);
        }

           foreach ($advisors as $advisors) 
        {
           $insert['user_id'] = $advisors;
           Tbl_approved_candidates::insert($insert);
        }
        dd(Request::all());
    }

    public function import_data_modal()
    {

      
    }

    public function import_template()
    {

      return view ('import_data_modal');




    }
}

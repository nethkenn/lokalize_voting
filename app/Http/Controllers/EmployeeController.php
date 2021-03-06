<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;

use Request;
use stdClass;
use Input;
use DateTime;
use Carbon\Carbon;

use App\Models\Tbl_advisor_votes;
use App\Models\Tbl_ambassador_votes;
use App\Models\Tbl_approved_candidates;
use App\Models\Tbl_global_board_of_directors_votes;
use App\Models\Tbl_positions;
use App\Models\Tbl_regional_board_of_directors_votes;
use App\Models\Tbl_user_voting_status;
use App\Models\Tbl_voting_user;

class EmployeeController extends Controller
{
    //
    public function index()
    {	
    	$data['global_candidate']     = Tbl_approved_candidates::JoinUser()->where("user_applied_position",1)->get();
    	$data['regional_candidate']   = Tbl_approved_candidates::JoinUser()->where("user_applied_position",2)->get();
    	$data['ambassador_candidate'] = Tbl_approved_candidates::JoinUser()->where("user_applied_position",3)->get();
    	$data['advisor_candidate']    = Tbl_approved_candidates::JoinUser()->where("user_applied_position",4)->get();

    	return view('employee.index',$data);
    }

    public function getcandidateinfo()
    {
    	$user_id           = Request::Input('candidate_id');
    	$data['candidate'] = Tbl_voting_user::where('user_id',$user_id)->first();
   		$data['divname']   = Request::Input('position');

    	return view('employee.voted_candidate',$data);
    }

    public function submit_votes()
    {
    	dd(Request::all());
    }
}

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
use App\Models\Tbl_positions;
use App\Models\Tbl_regional_board_of_directors_votes;
use App\Models\Tbl_user_voting_status;
use App\Models\Tbl_voting_user;
use App\Models\Tbl_applied_position;
use App\Models\Tbl_global_board_of_directors_votes;
use App\Globals\Login;
use Excel;
use DB;

class ResultsController extends Controller
{
    //
    public function results()
    {
  				$data["board"] = DB::table('tbl_global_board_of_directors_votes')->select('approved_candidate_id',DB::raw('count(*) as votes'),'user_first_name')->leftjoin('tbl_voting_user','tbl_global_board_of_directors_votes.approved_candidate_id','=','tbl_voting_user.user_id')->groupBy('approved_candidate_id')->get();

  				dd($data);



  				// $data["global"] = DB::table('tbl_ambassador_votes')->select('approved_candidate_id',DB::raw('count(*) as votes'))->groupBy('approved_candidate_id')->get();
  				// $data["regional"] = DB::table('tbl_ambassador_votes')->select('approved_candidate_id',DB::raw('count(*) as votes'))->groupBy('approved_candidate_id')->get();
      //            $data["ambassador"] = DB::table('tbl_ambassador_votes')->select('approved_candidate_id',DB::raw('count(*) as votes'))->groupBy('approved_candidate_id')->get();

 
                  
				  return view('results',$data);
    }

 
}

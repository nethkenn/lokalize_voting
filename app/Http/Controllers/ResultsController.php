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
use Model;

class ResultsController extends Controller
{
    //
    public static function total_vote_count($data)
    {
          $rowboard = array();
          foreach($data as $board)
          {
            $rowboard[] = $board->votes_count;
          }

          $total = array_sum($rowboard);

         return $total;
    }
    public function results()
    {
  				 // $data["board"] = DB::table('tbl_global_board_of_directors_votes')->select('approved_candidate_id',DB::raw('count(*) as votes'),'user_first_name')->leftjoin('tbl_voting_user','tbl_global_board_of_directors_votes.approved_candidate_id','=','tbl_voting_user.user_id')->groupBy('approved_candidate_id')->get();
       //     dd($data);


 
          $data["board"] = DB::table('tbl_global_board_of_directors_votes')
          ->select('tbl_global_board_of_directors_votes.approved_candidate_id', DB::raw('COUNT(*) as votes_count'), 'user_first_name','user_last_name','user_region')
          ->leftjoin('tbl_approved_candidates', 'tbl_global_board_of_directors_votes.approved_candidate_id', '=', 'tbl_approved_candidates.approved_candidate_id')
          ->leftjoin('tbl_voting_user','tbl_approved_candidates.user_id','=','tbl_voting_user.user_id')->groupBy('approved_candidate_id')->having('votes_count', '>' , 1)
          ->get();

          $data["total_board_vote_count"] = Self::total_vote_count($data["board"]);

          $data["global"] = DB::table('tbl_regional_board_of_directors_votes')
          ->select('tbl_regional_board_of_directors_votes.approved_candidate_id', DB::raw('COUNT(*) as votes_count'), 'user_first_name','user_last_name','user_region')
          ->leftjoin('tbl_approved_candidates', 'tbl_regional_board_of_directors_votes.approved_candidate_id', '=', 'tbl_approved_candidates.approved_candidate_id')
          ->leftjoin('tbl_voting_user','tbl_approved_candidates.user_id','=','tbl_voting_user.user_id')->groupBy('approved_candidate_id')->having('votes_count', '>' , 1)
          ->get();

          $data["total_global_vote_count"] = Self::total_vote_count($data["global"]);

           $data["regional"] = DB::table('tbl_ambassador_votes')
          ->select('tbl_ambassador_votes.approved_candidate_id', DB::raw('COUNT(*) as votes_count'), 'user_first_name','user_last_name','user_region')
          ->leftjoin('tbl_approved_candidates', 'tbl_ambassador_votes.approved_candidate_id', '=', 'tbl_approved_candidates.approved_candidate_id')
          ->leftjoin('tbl_voting_user','tbl_approved_candidates.user_id','=','tbl_voting_user.user_id')->groupBy('approved_candidate_id')->having('votes_count', '>' , 0)
          ->get();


          $data["total_regional_vote_count"] = Self::total_vote_count($data["regional"]);

          $data["ambas"] = DB::table('tbl_advisor_votes')
          ->select('tbl_advisor_votes.approved_candidate_id', DB::raw('COUNT(*) as votes_count'), 'user_first_name','user_last_name','user_region')
          ->leftjoin('tbl_approved_candidates', 'tbl_advisor_votes.approved_candidate_id', '=', 'tbl_approved_candidates.approved_candidate_id')
          ->leftjoin('tbl_voting_user','tbl_approved_candidates.user_id','=','tbl_voting_user.user_id')->groupBy('approved_candidate_id')->having('votes_count', '>' , 1)
          ->get();

          $data["total_ambas_vote_count"] = Self::total_vote_count($data["ambas"]);


  				



  				// $data["global"] = DB::table('tbl_ambassador_votes')->select('approved_candidate_id',DB::raw('count(*) as votes'))->groupBy('approved_candidate_id')->get();
  				// $data["regional"] = DB::table('tbl_ambassador_votes')->select('approved_candidate_id',DB::raw('count(*) as votes'))->groupBy('approved_candidate_id')->get();
      //            $data["ambassador"] = DB::table('tbl_ambassador_votes')->select('approved_candidate_id',DB::raw('count(*) as votes'))->groupBy('approved_candidate_id')->get();

 
                  
				  return view('results',$data);
    }

 
}

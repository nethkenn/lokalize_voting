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
  				$ambassador = DB::table('tbl_ambassador_votes')->select('approved_candidate_id',DB::raw('count(*) as votes'))->groupBy('approved_candidate_id')->get();
  				$ambassador = DB::table('tbl_ambassador_votes')->select('approved_candidate_id',DB::raw('count(*) as votes'))->groupBy('approved_candidate_id')->get();
  				$ambassador = DB::table('tbl_ambassador_votes')->select('approved_candidate_id',DB::raw('count(*) as votes'))->groupBy('approved_candidate_id')->get();
                 $ambassador = DB::table('tbl_ambassador_votes')->select('approved_candidate_id',DB::raw('count(*) as votes'))->groupBy('approved_candidate_id')->get();

   				  $data['ambassador_winner'] = Self::getHighestVotes($ambassador);
                  // dd($data);
				  return view('results',$data);
    }

    public static function getHighestVotes($votes)
    {
    	$winner = array();

    	foreach($votes as $vote)
    	{
    		if(count($winner) == 0)
    		{
    			$winner = $vote;
    		}
    		else
    		{
    			if($winner->votes < $vote->votes)
    			{
    				$winner = $vote;
    			}
    		}
    	}

    	return $winner;
    }
}

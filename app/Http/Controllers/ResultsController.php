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
use App\Models\Tbl_advisor_votes;
use App\Models\Tbl_ambassador_votes;
use App\Models\Tbl_approved_candidates;
use App\Models\Tbl_global_board_of_directors_votes;
use App\Models\Tbl_regional_board_of_directors_votes;
use App\Models\Tbl_voting_user;
use DB;




class ResultsController extends Controller
{
    //	
    public function results()
    {

    	 		$data['global_candidate']    	 = DB::table('Tbl_global_board_of_directors_votes')->select('approved_candidate_id',DB::raw('count(*) as votes'						 	))->groupBy('approved_candidate_id')->get();
                $data['regional_candidate']      = DB::table('Tbl_regional_board_of_directors_votes')->select('approved_candidate_id',DB::raw('count(*) as votes'							))->groupBy('approved_rcandidate_id')->get();
                $data['ambassador_candidate']    = DB::table('tbl_ambassado_votes')->select('approved_candidate_id',DB::raw('count(*) as votes'							))->groupBy('approved_candidate_id')->get();
                $data['advisor_candidate']       = DB::table('Tbl_advisor_votes')->select('approved_candidate_id',DB::raw('count(*) as votes'							))->groupBy('approved_candidate_id')->get();
                $data['global_candidate_votes']	 = DB::table('tbl_ambassador_votes')->select('approved_candidate_id',DB::raw('count(*) as votes'							))->groupBy('approved_candidate_id')->get();
              	dd($data);
    	return view("/results", $data);

    }

}

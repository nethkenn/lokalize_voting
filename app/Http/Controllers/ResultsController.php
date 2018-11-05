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
    public function results()
    {
 
          $data["board"] = DB::table('tbl_global_board_of_directors_votes')
          ->select('tbl_global_board_of_directors_votes.approved_candidate_id', DB::raw('COUNT(*) as votes_count'), 'user_first_name','user_last_name','user_region','tbl_voting_user.user_id')
          ->leftjoin('tbl_approved_candidates', 'tbl_global_board_of_directors_votes.approved_candidate_id', '=', 'tbl_approved_candidates.approved_candidate_id')
          ->leftjoin('tbl_voting_user','tbl_approved_candidates.user_id','=','tbl_voting_user.user_id')
          ->groupBy('approved_candidate_id')
          ->having('votes_count', '>' , 0)
          ->orderBy('votes_count','DESC')
          ->limit(5)
          ->get();

          $data["global"] = DB::table('tbl_regional_board_of_directors_votes')
          ->select('tbl_regional_board_of_directors_votes.approved_candidate_id', DB::raw('COUNT(*) as votes_count'), 'user_first_name','user_last_name','user_region','tbl_voting_user.user_id')
          ->leftjoin('tbl_approved_candidates', 'tbl_regional_board_of_directors_votes.approved_candidate_id', '=', 'tbl_approved_candidates.approved_candidate_id')
          ->leftjoin('tbl_voting_user','tbl_approved_candidates.user_id','=','tbl_voting_user.user_id')
          ->groupBy('approved_candidate_id')
          ->having('votes_count', '>' , 0)
          ->orderBy('votes_count','DESC')
          ->limit(10)
          ->get();

           $data["regional"] = DB::table('tbl_ambassador_votes')
          ->select('tbl_ambassador_votes.approved_candidate_id', DB::raw('COUNT(*) as votes_count'), 'user_first_name','user_last_name','user_region','tbl_voting_user.user_id')
          ->leftjoin('tbl_approved_candidates', 'tbl_ambassador_votes.approved_candidate_id', '=', 'tbl_approved_candidates.approved_candidate_id')
          ->leftjoin('tbl_voting_user','tbl_approved_candidates.user_id','=','tbl_voting_user.user_id')
          ->groupBy('approved_candidate_id')
          ->having('votes_count', '>' , 0)
          ->orderBy('votes_count','DESC')
          ->limit(10)
          ->get();


          $data["ambas"] = DB::table('tbl_advisor_votes')
          ->select('tbl_advisor_votes.approved_candidate_id', DB::raw('COUNT(*) as votes_count'), 'user_first_name','user_last_name','user_region','user_country','tbl_voting_user.user_id')
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
          

				  return view('results',$final_data);
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

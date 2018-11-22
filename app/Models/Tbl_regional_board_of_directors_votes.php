<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tbl_regional_board_of_directors_votes extends Model
{
    //
            protected $table = 'tbl_regional_board_of_directors_votes';
	protected $primaryKey = "regional_board_of_director_votes_id";
    public $timestamps = false;


	public function scopeGetVotesUser($query,$user_id)
	{
		$query->leftjoin('tbl_approved_candidates','tbl_regional_board_of_directors_votes.approved_candidate_id','=','tbl_approved_candidates.approved_candidate_id')
			->leftjoin('tbl_voting_user','tbl_approved_candidates.user_id','=','tbl_voting_user.user_id')
			->where('tbl_approved_candidates.position_id',2)
			->where('tbl_regional_board_of_directors_votes.user_id',$user_id);
		return $query;
	}
}

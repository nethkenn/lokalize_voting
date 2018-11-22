<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tbl_global_board_of_directors_votes extends Model
{
    //
    protected $table = 'tbl_global_board_of_directors_votes';
	protected $primaryKey = "global_board_of_director_votes_id";
    public $timestamps = false;

    public function scopeGetName($query)
	{
		$query->leftjoin('tbl_voting_user','tbl_global_board_of_directors_votes.approved_candidate_id','=','tbl_voting_user.user_id');
		return $query;
	}

	public function scopeGetVotesUser($query,$user_id)
	{
		$query->leftjoin('tbl_approved_candidates','tbl_global_board_of_directors_votes.approved_candidate_id','=','tbl_approved_candidates.approved_candidate_id')
			->leftjoin('tbl_voting_user','tbl_approved_candidates.user_id','=','tbl_voting_user.user_id')
			->where('tbl_global_board_of_directors_votes.user_id',$user_id);
		return $query;
	}
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tbl_ambassador_votes extends Model
{
    //
     protected $table = 'tbl_ambassador_votes';
	protected $primaryKey = "ambassador_votes_id";
    public $timestamps = false;

    public function scopeGetVotesUser($query,$user_id)
	{
		$query->leftjoin('tbl_approved_candidates','tbl_ambassador_votes.approved_candidate_id','=','tbl_approved_candidates.approved_candidate_id')
			->leftjoin('tbl_voting_user','tbl_approved_candidates.user_id','=','tbl_voting_user.user_id')
			->where('tbl_ambassador_votes.user_id',$user_id);
		return $query;
	}
}

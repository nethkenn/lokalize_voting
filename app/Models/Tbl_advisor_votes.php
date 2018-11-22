<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tbl_advisor_votes extends Model
{
    //
     protected $table = 'tbl_advisor_votes';
	protected $primaryKey = "advisor_votes_id";
    public $timestamps = false;

    public function scopeGetVotesUser($query,$user_id)
	{
		$query->leftjoin('tbl_approved_candidates','tbl_advisor_votes.approved_candidate_id','=','tbl_approved_candidates.approved_candidate_id')
			->leftjoin('tbl_voting_user','tbl_approved_candidates.user_id','=','tbl_voting_user.user_id')
			->where('tbl_approved_candidates.position_id',4)
			->where('tbl_advisor_votes.user_id',$user_id);
		return $query;
	}
}

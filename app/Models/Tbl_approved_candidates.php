<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tbl_approved_candidates extends Model
{
    //
    protected $table = 'tbl_approved_candidates';
	protected $primaryKey = "approved_candidate_id";
    public $timestamps = false;

    public function scopeJoinUser($query)
	{
		$query->leftjoin('tbl_voting_user','tbl_approved_candidates.user_id','=','tbl_voting_user.user_id');
		return $query;
	}
}

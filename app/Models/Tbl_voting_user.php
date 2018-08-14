<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tbl_voting_user extends Model
{
    //
    protected $table = 'tbl_voting_user';
	protected $primaryKey = "user_id";
    public $timestamps = false;

	public function scopeJoinUser($query)
	{
		$query->leftjoin('tbl_positions','tbl_voting_user.user_applied_position','=','tbl_positions.position_id');
		return $query;
	}

}

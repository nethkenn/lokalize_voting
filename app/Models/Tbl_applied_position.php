<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tbl_applied_position extends Model
{
    //
        protected $table = 'tbl_applied_position';
	protected $primaryKey = "applied_position_id";
    public $timestamps = false;

    public function scopeJoinUser($query)
	{
		$query->leftjoin('tbl_approved_candidates','tbl_applied_position.user_id','=','tbl_approved_candidates.user_id');
		return $query;
	}
}

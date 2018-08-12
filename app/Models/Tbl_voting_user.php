<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tbl_voting_user extends Model
{
    //
    protected $table = 'tbl_voting_user';
	protected $primaryKey = "user_id";
    public $timestamps = false;

}

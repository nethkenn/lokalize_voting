<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tbl_user_votes extends Model
{
    protected $table = 'tbl_user_votes';
	protected $primaryKey = "user_votes_id";
    public $timestamps = false;
}

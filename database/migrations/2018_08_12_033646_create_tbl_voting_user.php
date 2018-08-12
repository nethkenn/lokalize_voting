<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblVotingUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
          Schema::create('tbl_voting_user', function (Blueprint $table) {
            $table->increments('user_id');
            $table->string('user_email')->unique();
            $table->integer('user_applied_position');
            $table->string('user_password');
            $table->string('user_picture');
            $table->string('user_linked_in');
            $table->string('user_resume');
            $table->string('user_country');
            $table->string('user_region');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}

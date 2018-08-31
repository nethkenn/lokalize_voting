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
            $table->integer('user_type')->default('0');
            $table->string('user_name');
            $table->string('user_email')->unique();
            $table->string('user_password');
            $table->text('user_picture');
            $table->string('user_linked_in');
            $table->text('user_media_linked');
            $table->string('user_resume');
            $table->string('user_country')->nullable();
            $table->string('user_region');
            $table->string('user_first_name');
            $table->string('user_middle_name')->nullable();
            $table->string('user_last_name');
            $table->string('user_company_name')->nullable();
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

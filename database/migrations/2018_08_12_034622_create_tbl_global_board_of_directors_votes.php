<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblGlobalBoardOfDirectorsVotes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('tbl_global_board_of_directors_votes', function (Blueprint $table) {
            $table->increments('global_board_of_director_votes_id');
            $table->integer('user_id');
            $table->integer('approved_candidate_id');

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

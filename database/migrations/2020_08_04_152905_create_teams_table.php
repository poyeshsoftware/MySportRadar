<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teams', function (Blueprint $table) {
            $table->id();
            $table->char('name');
            $table->timestamps();
        });

        Schema::create('sport_team', function (Blueprint $table) {
            $table->id();
            $table->foreignId('_team_id');
            $table->foreignId('_sport_id');

            $table->foreign('_team_id')->references('id')->on('teams')->onDelete('cascade');
            $table->foreign('_sport_id')->references('id')->on('sports')->onDelete('cascade');

            $table->unique(array('_sport_id', '_team_id'));
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teams');
        Schema::dropIfExists('sport_teams');
    }
}

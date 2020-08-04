<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTheEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('the_events', function (Blueprint $table) {
            $table->id();
            $table->dateTime('date');
            $table->foreignId('_sport_id');
            $table->foreignId('_team_id_1');
            $table->foreignId('_team_id_2');
            $table->timestamps();

            $table->foreign('_sport_id')->references('id')->on('sports')->onDelete('cascade');
            $table->foreign('_team_id_1')->references('id')->on('teams')->onDelete('cascade');
            $table->foreign('_team_id_2')->references('id')->on('teams')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('the_events');
    }
}

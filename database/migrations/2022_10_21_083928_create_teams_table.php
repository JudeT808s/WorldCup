<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->string('name');
            $table->foreign('player_id')->constraint ('teams_player_id_foreign')->foreign ('player_id')->references ->player('id');
            $table->foreign('sponsor_id')->constraint ('teams_sponsor_id_foreign')->foreign ('sponsor_id')->references ->sponsor('id');
           // $table->foreign('sponsor_id')->references('id')->on('sponsors');
            $table->timestamps();
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
    }
};

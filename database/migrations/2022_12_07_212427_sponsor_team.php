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
        Schema::create('sponsor_team', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('team_id');
            $table->unsignedBigInteger('sponsor_id');

            $table->foreign('team_id')->references('id')->on('teams')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('sponsor_id')->references('id')->on('sponsors')->onUpdate('cascade')->onDelete('restrict');
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
        Schema::dropIfExists('sponsor_team');
        // $table->dropForeign((['team_id']));
        // $table->dropColumn((['team_id']));
        // $table->dropForeign((['sponsor_id']));
        // $table->dropColumn((['sponsor_id']));
    }
};
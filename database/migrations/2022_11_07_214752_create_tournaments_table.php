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
        Schema::create('tournaments', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('location');
            $table->string('description');
            $table->date('start_date');
            $table->timestamps();
            //Outlines foreign keys
            $table->foreignId('team_id')->constrained();
            $table->foreignId('user_id')->constrained();


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tournaments');
        //  Schema::table('tournaments', function (Blueprint $table){
        //     $table->dropForeign('user_id');
        //     $table->dropColumn('user_id');
        //  });
       

        }
};
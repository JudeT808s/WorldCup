<?php

namespace Database\Seeders;

use App\Models\Team;
use App\Models\Tournament;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Calls the corresponding factory and runs a certain amount of times to create data in the database
        Team::factory()->times(20)->create();

        // foreach (Tournament::all() as $tournament) {

        //     $team = Team::inRandomOrder()->take(rand(1, 3))->pluck('id');
        //     $tournament->teams()->attach($team);
        // }
    }
}
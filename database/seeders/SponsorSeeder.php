<?php

namespace Database\Seeders;

use App\Models\Team;
use App\Models\Sponsor;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SponsorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Sponsor::factory()
            ->times(3)
            ->has(
                Team::factory()
                    ->hasPlayers(11)
            )
            ->create();


        // foreach (Team::all() as $team) {
        //     $sponsors = Sponsor::inRandomOrder()->take(rand(1, 3))->pluck('id');
        //     $team->sponsors()->attach($sponsors);
        // }
    }
}
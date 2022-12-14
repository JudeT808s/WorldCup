<?php

namespace Database\Seeders;

use App\Models\Player;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PlayerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Calls the corresponding factory and runs a certain amount of times to create data in the database
        Player::factory()
            ->times(40)
            ->hasTeam(11)
            ->create();
    }
}
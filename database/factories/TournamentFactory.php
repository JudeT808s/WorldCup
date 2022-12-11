<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tournament>
 */
class TournamentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'location' => $this->faker->country,
            'start_date' => $this->faker->date,
            'description' => $this->faker->sentence,
            'user_id' => $this->faker->randomElement(User::pluck('id')),
            'team_id' => $this->faker->randomElement(Team::pluck('id')),

        ];
    }
}
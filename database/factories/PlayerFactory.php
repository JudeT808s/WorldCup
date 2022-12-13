<?php

namespace Database\Factories;

use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Player>
 */
class PlayerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'age' => $this->faker->numberBetween(18, 40),
            'skill_level' => $this->faker->numberBetween(0, 100),
            'country' => $this->faker->country,
            //Picks a random team_id and uses it as a foreign key this then connects back to the player model
            'teams_id' => $this->faker->randomElement(Team::pluck('id'))

        ];
    }
}
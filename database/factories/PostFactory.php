<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::pluck('id')[$this->faker->numberBetween(1,User::count()-1)],
            'title' => $this->faker->sentence(5),
            'body' => $this->faker->text,
        ];
    }
}

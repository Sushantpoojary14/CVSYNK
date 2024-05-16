<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PostsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'company_name' => fake()->company(),
            'state_id' => fake()->randomNumber(1,37),
            'city_id' =>fake()->randomNumber(1,2),
            'job_title' => fake()->jobTitle(),
            'job_description' =>fake()->sentence(),
            'job_requirement' => fake()->word(),
            'job_category_id' =>fake()->randomNumber(1,20),
            'user_id' =>1,
        ];
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Admin>
 */
class AdminFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // return [
        //     'name' => fake()->name(),
        //     'email' => fake()->unique()->safeEmail(),
        //     'email_verified_at' => now(),
        //     'password' => bcrypt('password'), // password
        //     'remember_token' => str_random(10),
        // ];

        return [

            'name' => 'Md Shakil Islam - Admin',
            'email' => 'freelancersuvo2022@gmail.com',
            'email_verified_at' => now(),
            'status' => 0,
            'password' => bcrypt('password'),
            // 'remember_token' => Str::random(10),
        ];
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\NextOfKin>
 */
class NextOfKinFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'firstname' => fake()->firstName(),
            'lastname' => fake()->lastName(),
            'dob' => fake()->date(),
            'email' => fake()->safeEmail(),
            'address' => fake()->address(),
            'phone' => fake()->phoneNumber()
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $gender = fake()->randomElement(['male', 'female']);
        $mainoneID = fake()->unique()->regexify('^MOSN[0-9]{1,4}$');
        $status = fake()->randomElement([User::ACTIVE, User::ACTIVE, User::PENDING, User::PENDING, User::DECLINED, User::INACTIVE]);

        $dateApproved = null;
        $dateDeactivated = null;
        $day = fake()->numberBetween(5, 90);
        $start = now()->subDays($day)->toDateTime();
        $now = now()->toDateTime();
        if($status == User::ACTIVE){
            $dateApproved = fake()->dateTimeBetween($start, $now);
        }
        if($status == User::INACTIVE){
            $dateDeactivated = fake()->dateTimeBetween($start, $now);
        }
        return [
            'mainone_id' => $mainoneID,
            'firstname' => fake()->firstName($gender),
            'middlename' => fake()->name($gender),
            'lastname' => fake()->lastName($gender),
            'email' => fake()->unique()->safeEmail(),
            'phone' => fake()->phoneNumber(),
            'email_verified_at' => now(),
            'password' => 'password', // password
            'remember_token' => Str::random(10),
            'dob' => fake()->date(),
            'address' => fake()->address(),
            'city' => fake()->city(),
            'state' => fake()->streetName(),
            'country' => 'Nigeria',
            'gender' => $gender,
            'status' => $status,
            'save_amount' => fake()->randomElement([5000, 10000, 30000, 50000, 300000, 5000000]),
            'date_approved' => $dateApproved,
            'date_deactivated' => $dateDeactivated
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}

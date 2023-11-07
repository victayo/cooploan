<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EmploymentDetails>
 */
class EmploymentDetailsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $department = fake()->randomElement(['Cooperate Services & Development', 'Finance', 'Technical']);
        $jobTitle = '';
        switch($department){
            case 'Cooperate Services & Development':
                $jobTitle = fake()->randomElement(['IT', 'HR', 'BMS']);
                break;
            case 'Finance':
                $jobTitle = fake()->randomElement(['Billing', 'Credit Control']);
                break;
            case 'Technical':
                $jobTitle = fake()->randomElement(['IP Operations', 'Transmission', 'Network Intelligence']);
                break;
            default:
                $jobTitle = 'Others';
        }
        $day = fake()->numberBetween(30, 365*10);
        $start = now()->subDays($day)->toDateTime();
        $now = now()->toDateTime();
        $resumption = fake()->dateTimeBetween($start, $now)->format('Y-m-d');
        return [
            'department' => $department,
            'resumption_date' => $resumption,
            'job_title' => $jobTitle,
            'is_permanent_staff' => fake()->randomElement([0, 1, 1, 1, 0])
        ];
    }
}

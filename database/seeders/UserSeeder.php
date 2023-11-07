<?php

namespace Database\Seeders;

use App\Models\EmploymentDetails;
use App\Models\NextOfKin;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::factory()->count(200)->create();
        $users->each(function($user){
            $mainoneID = $user->mainone_id;
            EmploymentDetails::factory()->create([
                'mainone_id' => $mainoneID
            ])->save();
            NextOfKin::factory()->create([
                'mainone_id' => $mainoneID
            ]);
        });
    }
}

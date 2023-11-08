<?php

namespace Database\Seeders;

use App\Models\EmploymentDetails;
use App\Models\NextOfKin;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $count = DB::table('users')->count();
        if(!$count){ //insert only if the users table is empty
            $mainoneId = 'MOCN00001';
            User::create([
                'mainone_id' => $mainoneId,
                'firstname' => 'Joseph',
                'middlename' => 'Admin',
                'lastname' => 'Uaboi',
                'email' => 'joe@mcoop.com',
                'phone' => '07030000000',
                'dob' => '2020-01-01',
                'password' => 'secret',
                'address' => 'No 2, lagos',
                'state' => 'Lagos',
                'city' => 'VI',
                'country' => 'Nigeria',
                'gender' => 'male',
                'save_amount' => 5000,
                'membership_fee' => 2000
            ]);

            EmploymentDetails::create([
                'mainone_id' => $mainoneId,
                'department' => 'Finance',
                'resumption_date' => '2018-01-01',
                'job_title' => 'Credit Control',
                'is_permanent_staff' => 1
            ]);

            NextOfKin::create([
                'mainone_id' => $mainoneId,
                'firstname' => 'Chiamaka',
                'lastname' => 'Justine',
                'dob' => '2020-01-01',
                'email' => 'ChiJus@gmail.com',
                'phone' => '07030111111',
                'address' => 'Excelad Estate'
            ]);
        }

        $this->call([
            UserSeeder::class,
            TenureSeeder::class,
            PermissionSeeder::class
        ]);
    }
}

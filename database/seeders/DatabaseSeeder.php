<?php

namespace Database\Seeders;

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
        User::create([
            'mainone_id' => 'MOCN00001',
            'firstname' => 'Admin',
            'middlename' => 'Admin',
            'lastname' => 'Admin',
            'email' => 'admin@argon.com',
            'dob' => '2020-01-01',
            'password' => 'secret',
            'address' => 'No 2, lagos',
            'state' => 'Lagos',
            'city' => 'VI',
            'country' => 'Nigeria',
            'gender' => 'male'
        ]);
    }
}

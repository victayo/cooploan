<?php

namespace Database\Seeders;

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
        DB::table('users')->insert([
            'mainone_id' => 'MOCN00001',
            'firstname' => 'Admin',
            'middlename' => 'Admin',
            'lastname' => 'Admin',
            'email' => 'admin@argon.com',
            'dob' => '2020-01-01',
            'password' => bcrypt('secret'),
            'address' => 'No 2, lagos',
            'state' => 'Lagos',
            'city' => 'VI',
            'country' => 'Nigeria'
        ]);
    }
}

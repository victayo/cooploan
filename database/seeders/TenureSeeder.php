<?php

namespace Database\Seeders;

use App\Models\Tenure;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TenureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tenures')->truncate();
        for($i = 2; $i <= 36; $i++){
            if($i >= 2 && $i <= 18){ // 2 - 18 months, interest is 10%
                $interest = 10;
            }else if($i > 18 && $i <= 24){// 19 - 24 months, interest is 12%
                $interest = 12;
            }else{ // 25 - 36 months, interest is 15%
                $interest = 15;
            }

            Tenure::create([
                'tenure' => $i,
                'interest' => $interest
            ]);
        }


    }
}

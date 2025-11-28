<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class BsConductsTrainingPlaceMasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $now = Carbon::now();
         DB::table('bs_conducts_training_place_master')->insert([
            ['name' => 'SCHOOL PREMISES', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'OTHER THAN SCHOOL PREMISES', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'BOTH 1 & 2', 'created_at' => $now, 'updated_at' => $now]
           
        ]);
    }
}

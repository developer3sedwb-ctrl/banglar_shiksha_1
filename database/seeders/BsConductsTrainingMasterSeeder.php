<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class BsConductsTrainingMasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $now = Carbon::now();
         DB::table('bs_conducts_training_master')->insert([
            ['name' => 'SPECIALLY ENGAGED TEACHERS', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'OTHERS', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'NGO', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'BOTH 1&2', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'SCHOOL TEACHERS', 'created_at' => $now, 'updated_at' => $now]
        ]);
    }
}

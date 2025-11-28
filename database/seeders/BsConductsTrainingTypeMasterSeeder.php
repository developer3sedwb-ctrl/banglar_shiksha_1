<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class BsConductsTrainingTypeMasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $now = Carbon::now();
        DB::table('bs_conducts_training_type_master')->insert([
            ['name' => 'RESIDENTIAL', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'NON-RESIDENTIAL', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'BOTH', 'created_at' => $now, 'updated_at' => $now]
           
        ]);
    }
}

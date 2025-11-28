<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class BsComputerLabModelMasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
         $now = Carbon::now();
         DB::table('bs_computer_lab_model_master')->insert([
            ['name' => 'BOOT Model', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'BOO Model', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Other', 'created_at' => $now, 'updated_at' => $now]
        ]);
    }
}

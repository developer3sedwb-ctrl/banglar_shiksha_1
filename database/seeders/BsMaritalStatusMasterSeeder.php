<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class BsMaritalStatusMasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $now = Carbon::now();
        DB::table('bs_marital_status_master')->insert([
            ['name' => 'MARRIED', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'UN-MARRIED', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'WIDOW', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'WIDOWER', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'DIVORCEE', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'SEPERATE', 'created_at' => $now, 'updated_at' => $now]
        ]);
    }
}

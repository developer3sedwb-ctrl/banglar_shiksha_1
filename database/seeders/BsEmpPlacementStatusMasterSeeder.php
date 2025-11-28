<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class BsEmpPlacementStatusMasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $now = Carbon::now();
        DB::table('bs_emp_placement_status_master')->insert([
            ['name' => 'T PLACEMENT', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'DID NOT T PLACEMENT', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'ENGAGED IN SELF EMPLOYMENT', 'created_at' => $now, 'updated_at' => $now]
        ]);
    }
}

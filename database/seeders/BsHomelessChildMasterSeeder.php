<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class BsHomelessChildMasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $now = Carbon::now();
        DB::table('bs_homeless_child_master')->insert([
            ['name' => 'HOMELESS AND STAYING ON STREETS WITH PARENT/GUARDIAN (NOT STAYING IN HOME)', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'HOMELESS AND STAYING ON STREETS WITHOUT ADULT PROTECTION', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'NOT APPLICABLE', 'created_at' => $now, 'updated_at' => $now],
        ]);
    }
}

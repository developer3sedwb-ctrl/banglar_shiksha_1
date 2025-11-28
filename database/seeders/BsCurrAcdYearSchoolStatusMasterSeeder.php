<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class BsCurrAcdYearSchoolStatusMasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $now = Carbon::now();
         DB::table('bs_curr_acd_year_school_status_master')->insert([
            ['name' => 'CONTINUING IN THE SAME SCHOOL', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'LEFT THE SCHOOL WITH TRANSFER CERTIFICATE', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'LEFT THE SCHOOL WITHOUT TRANSFER CERTIFICATE', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'NEW ADMISSION IN ANY GRADE', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'NEW ADMISSION THROUGH AFFIDAVIT OR SPECIAL TRAINING', 'created_at' => $now, 'updated_at' => $now]           
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class BsReasonStudentDeactivationMasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('bs_reason_student_deactivation_master')->insert([
            ['id'=>1, 'name' => 'Not readmitted', 'status' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id'=>2, 'name' => 'Not attended school since long', 'status' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id'=>4, 'name' => 'Migrated', 'status' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            
        ]);

    }
}

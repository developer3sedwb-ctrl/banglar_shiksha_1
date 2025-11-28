<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class BsDropStudentReasonMasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $now = Carbon::now();
        DB::table('bs_drop_student_reason_master')->insert([
            ['name' => 'Image not upload', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Other', 'created_at' => $now, 'updated_at' => $now]
        ]);
    }
}

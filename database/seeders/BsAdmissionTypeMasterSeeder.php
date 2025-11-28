<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class BsAdmissionTypeMasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $now = Carbon::now();
        $data = [
            [
                'id'         => 1,
                'name'       => 'FIRST TIME ADMISSION',
                'status'     => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id'         => 2,
                'name'       => 'NEW ADMISSION WITH TC/ SLC',
                'status'     => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];
        DB::table('bs_admission_type_master')->insert($data);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class BsPreviousSchoolingTypeMasterSeeder extends Seeder
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
                'id'         => 3,
                'name'       => 'Anganwadi/ ECCE Centre',
                'status'     => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id'         => 4,
                'name'       => 'None/Not Studying',
                'status'     => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id'         => 1,
                'name'       => 'Studied at Current/Same School',
                'status'     => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id'         => 2,
                'name'       => 'Studied at Other School',
                'status'     => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];
        DB::table('bs_previous_schooling_type_master')->insert($data);
    }
}

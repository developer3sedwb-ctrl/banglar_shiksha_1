<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class BsReligionMasterSeeder extends Seeder
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
                'id'         => 12,
                'name'       => 'CWSN',
                'status'     => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id'         => 0,
                'name'       => 'HINDU',
                'status'     => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id'         => 5,
                'name'       => 'MUSLIM',
                'status'     => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id'         => 6,
                'name'       => 'CHRISTIAN',
                'status'     => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id'         => 7,
                'name'       => 'SIKH',
                'status'     => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id'         => 8,
                'name'       => 'BUDDHIST',
                'status'     => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id'         => 9,
                'name'       => 'PARSI',
                'status'     => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id'         => 10,
                'name'       => 'JAIN',
                'status'     => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id'         => 11,
                'name'       => 'OTHERS',
                'status'     => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];
        DB::table('bs_religion_master')->insert($data);

    }
}

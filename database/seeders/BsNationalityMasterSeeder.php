<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class BsNationalityMasterSeeder extends Seeder
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
                'name'       => 'INDIAN',
                'status'     => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id'         => 2,
                'name'       => 'OTHER',
                'status'     => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];
        DB::table('bs_nationality_master')->insert($data);

    }
}

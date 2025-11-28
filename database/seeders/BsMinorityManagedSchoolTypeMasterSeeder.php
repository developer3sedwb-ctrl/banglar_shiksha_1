<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class BsMinorityManagedSchoolTypeMasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();
        $data = [
            ['id' => 1, 'name' => 'MUSLIM',               'created_at' => $now, 'updated_at' => $now],
            ['id' => 2, 'name' => 'SIKH',                 'created_at' => $now, 'updated_at' => $now],
            ['id' => 3, 'name' => 'JAIN',                 'created_at' => $now, 'updated_at' => $now],
            ['id' => 4, 'name' => 'CHRISTIAN',            'created_at' => $now, 'updated_at' => $now],
            ['id' => 5, 'name' => 'PARSI',                'created_at' => $now, 'updated_at' => $now],
            ['id' => 6, 'name' => 'BUDDHIST',             'created_at' => $now, 'updated_at' => $now],
            ['id' => 7, 'name' => 'OTHERS',               'created_at' => $now, 'updated_at' => $now],
            ['id' => 8, 'name' => 'LINGUISTIC MINORITY',  'created_at' => $now, 'updated_at' => $now],
        ];

        DB::table('bs_minority_managed_school_type_master')->insert($data);
    }
}

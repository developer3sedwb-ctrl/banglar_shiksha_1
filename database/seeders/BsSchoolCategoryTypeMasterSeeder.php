<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class BsSchoolCategoryTypeMasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();
        $data = [
            ['id' => 1,  'name' => 'Dept. of Education / Aided',              'created_at' => $now, 'updated_at' => $now],
            ['id' => 2,  'name' => 'Govt. Sponsored',                         'created_at' => $now, 'updated_at' => $now],
            ['id' => 3,  'name' => 'Govt. State Plan',                        'created_at' => $now, 'updated_at' => $now],
            ['id' => 4,  'name' => 'DA Getting',                              'created_at' => $now, 'updated_at' => $now],
            ['id' => 5,  'name' => 'Govt.',                                   'created_at' => $now, 'updated_at' => $now],
            ['id' => 6,  'name' => 'Model',                                   'created_at' => $now, 'updated_at' => $now],
            ['id' => 7,  'name' => 'NIGS',                                    'created_at' => $now, 'updated_at' => $now],
            ['id' => 8,  'name' => 'Other Govt. School',                      'created_at' => $now, 'updated_at' => $now],
            ['id' => 9,  'name' => 'Certral Govt. School',                    'created_at' => $now, 'updated_at' => $now],
            ['id' => 10, 'name' => 'KMC School',                              'created_at' => $now, 'updated_at' => $now],
            ['id' => 11, 'name' => 'KMC SSK',                                 'created_at' => $now, 'updated_at' => $now],
            ['id' => 12, 'name' => 'Madrasa MSK / SSK',                       'created_at' => $now, 'updated_at' => $now],
            ['id' => 13, 'name' => 'Munc. / Corp. run School / SSP / SSK',    'created_at' => $now, 'updated_at' => $now],
            ['id' => 14, 'name' => 'SSK',                                     'created_at' => $now, 'updated_at' => $now],
            ['id' => 15, 'name' => 'MSK',                                     'created_at' => $now, 'updated_at' => $now],
            ['id' => 16, 'name' => 'Other Recognized',                        'created_at' => $now, 'updated_at' => $now],
            ['id' => 17, 'name' => 'Other Unrecognized',                      'created_at' => $now, 'updated_at' => $now],
        ];

        DB::table('bs_school_category_type_master')->insert($data);

    }
}

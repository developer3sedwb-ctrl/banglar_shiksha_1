<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class BsManagementAndSchoolCategoryTypeMappingMasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['management_id' => 1, 'school_category_type_id' => 1],
            ['management_id' => 1, 'school_category_type_id' => 3],
            ['management_id' => 1, 'school_category_type_id' => 5],
            ['management_id' => 1, 'school_category_type_id' => 6],
            ['management_id' => 1, 'school_category_type_id' => 7],
            ['management_id' => 2, 'school_category_type_id' => 8],
            ['management_id' => 3, 'school_category_type_id' => 10],
            ['management_id' => 3, 'school_category_type_id' => 11],
            ['management_id' => 3, 'school_category_type_id' => 13],
            ['management_id' => 4, 'school_category_type_id' => 4],
            ['management_id' => 5, 'school_category_type_id' => 16],
            ['management_id' => 6, 'school_category_type_id' => 8],
            ['management_id' => 8, 'school_category_type_id' => 17],
            ['management_id' => 12, 'school_category_type_id' => 14],
            ['management_id' => 12, 'school_category_type_id' => 15],
            ['management_id' => 13, 'school_category_type_id' => 12],
            ['management_id' => 15, 'school_category_type_id' => 2],
            ['management_id' => 16, 'school_category_type_id' => 8],
            ['management_id' => 89, 'school_category_type_id' => 8],
            ['management_id' => 90, 'school_category_type_id' => 8],
            ['management_id' => 91, 'school_category_type_id' => 9],
            ['management_id' => 92, 'school_category_type_id' => 9],
            ['management_id' => 93, 'school_category_type_id' => 9],
            ['management_id' => 94, 'school_category_type_id' => 9],
            ['management_id' => 95, 'school_category_type_id' => 9],
            ['management_id' => 96, 'school_category_type_id' => 9],
            ['management_id' => 97, 'school_category_type_id' => 8],
            ['management_id' => 98, 'school_category_type_id' => 17],
            ['management_id' => 99, 'school_category_type_id' => 16],
            ['management_id' => 101, 'school_category_type_id' => 9],
        ];

        foreach ($data as $row) {

            // Skip if management does not exist
            $mgmtExists = DB::table('bs_management_master')
                ->where('id', $row['management_id'])
                ->exists();

            // Skip if school category type does not exist
            $catExists = DB::table('bs_school_category_type_master')
                ->where('id', $row['school_category_type_id'])
                ->exists();

            if (!($mgmtExists && $catExists)) {
                continue; // Skip invalid FK rows
            }

            DB::table('bs_management_and_school_category_type_mapping_master')
                ->insert([
                    'management_id' => $row['management_id'],
                    'school_category_type_id' => $row['school_category_type_id'],
                    'status' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
        }
    }
}

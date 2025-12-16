<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class BsStudentResidenceToSchoolDistanceMasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $data = [
            ['id' => 1, 'name' => 'less than 1 km',  'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'name' => 'between 1-3 kms', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'name' => 'between 3-5 kms', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 4, 'name' => 'more than 5 kms', 'created_at' => now(), 'updated_at' => now()]
        ];
        DB::table('bs_student_residence_to_school_distance')->insert($data);
    }
}

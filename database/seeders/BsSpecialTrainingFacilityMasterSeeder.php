<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BsSpecialTrainingFacilityMasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        $facilities = [
            ['name' => 'NON RESIDENTIAL', 'rank' => 10],
            ['name' => 'NOT APPLICABLE', 'rank' => 20],
            ['name' => 'RESIDENTIAL', 'rank' => 30],
        ];

        $data = array_map(fn($facility) => [
            'name' => $facility['name'],
            'rank' => $facility['rank'],
            'status' => 1,
            'created_at' => $now,
            'updated_at' => $now,
        ], $facilities);

        DB::table('bs_special_training_facility_master')->insert($data);
    }
}

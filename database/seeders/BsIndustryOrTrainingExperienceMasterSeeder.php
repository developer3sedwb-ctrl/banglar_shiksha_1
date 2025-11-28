<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class BsIndustryOrTrainingExperienceMasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $now = Carbon::now();
        DB::table('bs_industry_or_training_experience_master')->insert([
            ['name' => 'Less than 1 year', 'created_at' => $now, 'updated_at' => $now],
            ['name' => '1 to 2 Years', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'above 2 but less than 3 Year', 'created_at' => $now, 'updated_at' => $now],
            ['name' => '3 or + Years', 'created_at' => $now, 'updated_at' => $now]
        ]);

    }
}

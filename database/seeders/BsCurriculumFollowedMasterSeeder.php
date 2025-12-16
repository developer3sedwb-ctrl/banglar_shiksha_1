<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class BsCurriculumFollowedMasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $now = Carbon::now();
         DB::table('bs_curriculum_followed_master')->insert([
            ['name' => 'CBSE', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'CISCE', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'WBBPE', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'OTHER', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'WBBSE', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'WBCHSE', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'WBBME', 'created_at' => $now, 'updated_at' => $now],
        ]);
    }
}

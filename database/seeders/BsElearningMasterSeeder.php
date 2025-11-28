<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class BsElearningMasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        DB::table('bs_elearning_master')->insert([
            ['name' => 'TEACHER MANUAL', 'image_link' => 'teacher\'s_mannual.png', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'FORMATIVE EVALUATION', 'image_link' => 'farmattive_evaluation.png', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'ENGLISH SUPPORT MATERIAL', 'image_link' => 'english_supportive_material.png', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'PRE-PRIMARY', 'image_link' => 'pre_primary.png', 'created_at' => $now, 'updated_at' => $now],
        ]);
    }
}

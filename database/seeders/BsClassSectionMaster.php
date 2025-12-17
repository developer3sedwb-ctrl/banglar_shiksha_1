<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class BsClassSectionMaster extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $now = Carbon::now();
        DB::table('bs_class_section_master')->insert([
            ['name' => 'A', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'B', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'C', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'D', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'E', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'F', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'G', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'H', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'I', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'J', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'K', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'L', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'M', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'N', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'O', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'P', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Q', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'R', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'S', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'T', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'U', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'V', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'W', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'X', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Y', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Z', 'created_at' => $now, 'updated_at' => $now]
        ]);
    }
}

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
            ['id'=>1,'name' => 'A', 'created_at' => $now, 'updated_at' => $now],
            ['id'=>2,'name' => 'B', 'created_at' => $now, 'updated_at' => $now],
            ['id'=>3,'name' => 'C', 'created_at' => $now, 'updated_at' => $now],
            ['id'=>4,'name' => 'D', 'created_at' => $now, 'updated_at' => $now],
            ['id'=>5,'name' => 'E', 'created_at' => $now, 'updated_at' => $now],
            ['id'=>6,'name' => 'F', 'created_at' => $now, 'updated_at' => $now],
            ['id'=>7,'name' => 'G', 'created_at' => $now, 'updated_at' => $now],
            ['id'=>8,'name' => 'H', 'created_at' => $now, 'updated_at' => $now],
            ['id'=>9,'name' => 'I', 'created_at' => $now, 'updated_at' => $now],
            ['id'=>10,'name' => 'J', 'created_at' => $now, 'updated_at' => $now],
            ['id'=>11,'name' => 'K', 'created_at' => $now, 'updated_at' => $now],
            ['id'=>12,'name' => 'L', 'created_at' => $now, 'updated_at' => $now],
            ['id'=>13,'name' => 'M', 'created_at' => $now, 'updated_at' => $now],
            ['id'=>14,'name' => 'N', 'created_at' => $now, 'updated_at' => $now],
            ['id'=>15,'name' => 'O', 'created_at' => $now, 'updated_at' => $now],
            ['id'=>16,'name' => 'P', 'created_at' => $now, 'updated_at' => $now],
            ['id'=>17,'name' => 'Q', 'created_at' => $now, 'updated_at' => $now],
            ['id'=>18,'name' => 'R', 'created_at' => $now, 'updated_at' => $now],
            ['id'=>19,'name' => 'S', 'created_at' => $now, 'updated_at' => $now],
            ['id'=>20,'name' => 'T', 'created_at' => $now, 'updated_at' => $now],
            ['id'=>21,'name' => 'U', 'created_at' => $now, 'updated_at' => $now],
            ['id'=>22,'name' => 'V', 'created_at' => $now, 'updated_at' => $now],
            ['id'=>23,'name' => 'W', 'created_at' => $now, 'updated_at' => $now],
            ['id'=>24,'name' => 'X', 'created_at' => $now, 'updated_at' => $now],
            ['id'=>25,'name' => 'Y', 'created_at' => $now, 'updated_at' => $now],
            ['id'=>26,'name' => 'Z', 'created_at' => $now, 'updated_at' => $now],
            ['id'=>999,'name' => 'NOT APPLICABLE', 'created_at' => $now, 'updated_at' => $now]
        ]);
    }
}

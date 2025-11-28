<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class BsElementaryRsultCategoryMasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $now = Carbon::now();
        DB::table('bs_elementary_result_category_master')->insert([
            ['name' => 'Number of Students Appeared', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Number of Students Passed / Qualified', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Number of Students Passed with Marks>=60%', 'created_at' => $now, 'updated_at' => $now]
        ]);
    }
}

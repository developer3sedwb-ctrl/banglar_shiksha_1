<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class BsMarksRangeMasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        DB::table('bs_marks_range_master')->insert([
            ['name' => 'below 40%',        'created_at' => $now, 'updated_at' => $now],
            ['name' => '40% to below 60%',  'created_at' => $now, 'updated_at' => $now],
            ['name' => '60% to below 80%',  'created_at' => $now, 'updated_at' => $now],
            ['name' => '80% and Above',      'created_at' => $now, 'updated_at' => $now],
        ]);
    }
}

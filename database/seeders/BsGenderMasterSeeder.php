<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class BsGenderMasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $now = Carbon::now();
        DB::table('bs_gender_master')->insert([
            ['name' => 'MALE', 'gender_abb' => 'M', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'FEMALE', 'gender_abb' => 'F', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'TRANSGENDER', 'gender_abb' => 'T', 'created_at' => $now, 'updated_at' => $now],
        ]);
    }
}

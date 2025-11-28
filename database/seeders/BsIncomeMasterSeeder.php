<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class BsIncomeMasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $now = Carbon::now();
        DB::table('bs_income_master')->insert([
            ['name' => '0-50,000', 'created_at' => $now, 'updated_at' => $now],
            ['name' => '50,001-1,20,000', 'created_at' => $now, 'updated_at' => $now],
            ['name' => '1,20,001-2,50,000', 'created_at' => $now, 'updated_at' => $now],
            ['name' => '2,50,000-5,00,00', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Above 5,00,000', 'created_at' => $now, 'updated_at' => $now]
        ]);

    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class BsDiningHallFundMasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $now = Carbon::now();
        DB::table('bs_dining_hall_fund_master')->insert([
            ['name' => 'Dining Hall fund', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Other MDM fund', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Others fund', 'created_at' => $now, 'updated_at' => $now]
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class BsLpgFundMasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $now = Carbon::now();
        DB::table('bs_lpg_fund_master')->insert([
            ['name' => 'LPG fund', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Other MDM fund', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Others fund', 'created_at' => $now, 'updated_at' => $now]
        ]);
    }
}

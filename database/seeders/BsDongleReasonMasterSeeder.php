<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class BsDongleReasonMasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $now = Carbon::now();
        DB::table('bs_dongle_reason_master')->insert([
            ['name' => 'Mobile Shadow Zone', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Contacted with Nodal Officer of JIO', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Informed DI/S', 'created_at' => $now, 'updated_at' => $now]
        ]);
    }
}

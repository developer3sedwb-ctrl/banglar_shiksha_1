<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class BsDiningHallConditionMasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $now = Carbon::now();
        DB::table('bs_dining_hall_condition_master')->insert([
            ['name' => 'Good', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Require Repair', 'created_at' => $now, 'updated_at' => $now]
        ]);
    }
}

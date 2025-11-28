<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class BsComputerLabMasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $now = Carbon::now();
        DB::table('bs_computer_lab_master')->insert([
            ['name' => 'ICT', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'CAL', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Both ICT & CAL', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'None', 'created_at' => $now, 'updated_at' => $now]
        ]);
    }
}

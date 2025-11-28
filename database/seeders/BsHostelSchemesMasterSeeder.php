<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class BsHostelSchemesMasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();
        DB::table('bs_hostel_schemes_master')->insert([
            ['name' => 'RMSA', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'BRGF', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'KGBF', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'MODEL', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'NOT APPLICABLE', 'created_at' => $now, 'updated_at' => $now]
        ]);
    }
}

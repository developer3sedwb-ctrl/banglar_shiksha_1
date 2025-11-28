<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class BsChildMainstreamedMasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        DB::table('bs_child_mainstreamed_master')->insert([
            [
                'name' => 'In current academic year',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'In earlier academic year',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}

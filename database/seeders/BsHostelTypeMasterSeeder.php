<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class BsHostelTypeMasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $now = Carbon::now();
        DB::table('bs_hostel_type_master')->insert([
            ['name' => 'BOYS', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'GIRLS', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'BOYS AND GIRLS', 'created_at' => $now, 'updated_at' => $now]
        ]);
    }
}

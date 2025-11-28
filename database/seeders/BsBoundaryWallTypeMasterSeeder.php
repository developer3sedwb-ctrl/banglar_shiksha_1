<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BsBoundaryWallTypeMasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('bs_boundary_wall_type_master')->insert([
            ['name' => 'PUCCA','created_at' => Carbon::Now(),'updated_at' => Carbon::Now()],
            ['name' => 'PUCCA BUT BROKEN','created_at' => Carbon::Now(),'updated_at' => Carbon::Now()],
            ['name' => 'BARBED WIRE FENCING','created_at' => Carbon::Now(),'updated_at' => Carbon::Now()],
            ['name' => 'HEDGES','created_at' => Carbon::Now(),'updated_at' => Carbon::Now()],
            ['name' => 'NO BOUNDARY WALLS','created_at' => Carbon::Now(),'updated_at' => Carbon::Now()],
            ['name' => 'OTHERS','created_at' => Carbon::Now(),'updated_at' => Carbon::Now()],
            ['name' => 'PARTIAL','created_at' => Carbon::Now(),'updated_at' => Carbon::Now()],
            ['name' => 'UNDER CONSTRUCTION','created_at' => Carbon::Now(),'updated_at' => Carbon::Now()],
        ]);
    }
}

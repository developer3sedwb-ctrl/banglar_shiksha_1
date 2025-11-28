<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class BsDigitalDevicesIncMasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $now = Carbon::now();
        DB::table('bs_digital_devices_inc_master')->insert([
            ['name' => 'Mobile', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Laptops', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Smart Boards', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Desktops', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Projectors', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'The use of computers to retrieve', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Assess', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Store', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Produce', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Present and exchange information', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Interacting through digital technologies', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Protecting personal data and privacy', 'created_at' => $now, 'updated_at' => $now],
        ]);
    }
}

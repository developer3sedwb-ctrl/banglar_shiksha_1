<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class BsCountryMasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $now = Carbon::now();
         DB::table('bs_country_master')->insert([
            ['name' => 'INDIA', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'NEPAL', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'BHUTAN', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'BANGLADESH', 'created_at' => $now, 'updated_at' => $now]
           
        ]);
    }
}

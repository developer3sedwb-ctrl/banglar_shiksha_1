<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class BsLocationTypeMasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $now = Carbon::now();
        DB::table('bs_location_type_master')->insert([
            ['name' => 'RURAL', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'URBAN', 'created_at' => $now, 'updated_at' => $now]
          
        ]);
    }
}

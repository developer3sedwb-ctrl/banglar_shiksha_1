<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class BsTypeMasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $data = [
            ['id'=> 1,'name' => 'BOYS', 'created_at' => now(), 'updated_at' => now()],
            ['id'=> 2, 'name' => 'GIRLS', 'created_at' => now(), 'updated_at' => now()],
            ['id'=> 3,'name' => 'CO-EDUCATIONAL', 'created_at' => now(), 'updated_at' => now()],
        ];
        DB::table('bs_type_master')->insert($data);
    }
}

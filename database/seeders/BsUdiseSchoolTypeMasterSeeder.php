<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class BsUdiseSchoolTypeMasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $rows = [
            ['name' => 'Pre-Primary'],
            ['name' => 'Primary'],
            ['name' => 'Upper Primary'],
            ['name' => 'Secondary'],
            ['name' => 'Higher Secondary']        
        ];
        $data = [];
        $now = Carbon::now();
        foreach ($rows as $r) {
            $data[] = [
                'name'                   => $r['name'],
                'created_at'             => $now,
                'updated_at'             => $now
            ];
        }

        DB::table('bs_udise_school_type_master')->insert($data);

    }
}

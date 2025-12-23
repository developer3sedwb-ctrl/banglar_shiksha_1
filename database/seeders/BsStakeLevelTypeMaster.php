<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class BsStakeLevelTypeMaster extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();
        DB::table('bs_stake_level_type_master')->insert([
            ['id' => 1,  'name' => 'Super Admin',                     'status' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 2,  'name' => 'State Level User',                'status' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 3,  'name' => 'District Level User',             'status' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 4,  'name' => 'SDO Level User',                  'status' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 5,  'name' => 'Block Level User',                'status' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 6,  'name' => 'School Level User',               'status' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 7,  'name' => 'Webmaster',                       'status' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 8,  'name' => 'Municipal Corporation Level',     'status' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 9,  'name' => 'Municipality Level User',         'status' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 10, 'name' => 'Circle Level User',               'status' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 11, 'name' => 'CA Level User',                   'status' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 12, 'name' => 'Auditor Level User',              'status' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 13, 'name' => 'Data Entry Operator',             'status' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 14, 'name' => 'Guest User',                      'status' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 15, 'name' => 'Online Test Admin',               'status' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 16, 'name' => 'Project Level User',              'status' => 1, 'created_at' => $now, 'updated_at' => $now],
        ]);


    }
}

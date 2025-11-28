<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class BsDataPublishingCodeMasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
         $now = Carbon::now();
         DB::table('bs_data_publishing_code_master')->insert([
            ['name' => 'TENDERS',                'status' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'SCHOLARSHIP FORM',       'status' => 0, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'RESULTS',                'status' => 0, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'MODEL Q & A',            'status' => 0, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'ORDERS',                 'status' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'NOTIFICATION',           'status' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'RECRUITMENT',            'status' => 0, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'LETTERS',                'status' => 0, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'NOTICE',                 'status' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'NEWS / EVENTS',          'status' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'ALL',                    'status' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'ANNOUNCEMENTS',          'status' => 0, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'REPORTS & PUBLICATION',  'status' => 0, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'PRESS RELEASES',         'status' => 0, 'created_at' => $now, 'updated_at' => $now]
        ]);
    }
}

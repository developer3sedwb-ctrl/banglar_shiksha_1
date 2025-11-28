<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class BsFacilitiesCwsnMasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
$now = Carbon::now();

        $facilities = [
            ['id' => '1', 'name' => 'BRAILL BOOK',      'status_flag' => 'N', 'udise_status' => 1],
            ['id' => '2', 'name' => 'BRAILL KIT',       'status_flag' => 'N', 'udise_status' => 1],
            ['id' => '3', 'name' => 'LOW VISION KIT',   'status_flag' => 'N', 'udise_status' => 1],
            ['id' => '4', 'name' => 'HEARING AID',      'status_flag' => 'N', 'udise_status' => 1],
            ['id' => '5', 'name' => 'BRACES',           'status_flag' => 'N', 'udise_status' => 1],
            ['id' => '6', 'name' => 'CRUTCHES',         'status_flag' => 'N', 'udise_status' => 1],
            ['id' => '7', 'name' => 'WHEEL CHAIR',      'status_flag' => 'N', 'udise_status' => 1],
            ['id' => '8', 'name' => 'TRI-CYCLE',        'status_flag' => 'N', 'udise_status' => 1],
            ['id' => '9', 'name' => 'CALIPER',          'status_flag' => 'N', 'udise_status' => 1],
            ['id' => '11', 'name' => 'OTHERS',           'status_flag' => 'N', 'udise_status' => 0],
            ['id' => '12', 'name' => 'ESCORT',           'status_flag' => 'O', 'udise_status' => 1],
            ['id' => '10', 'name' => 'STIPEND',          'status_flag' => 'O', 'udise_status' => 1],
            ['id' => '999', 'name' => 'NOT APPLICABLE',   'status_flag' => 'N', 'udise_status' => 0],
        ];

        foreach ($facilities as $facility) {
            $status = match ($facility['status_flag']) {
                'N' => 1,
                'O' => 2,
                default => 1,
            };

            DB::table('bs_facilities_cwsn_master')->updateOrInsert(
                ['id' => $facility['id']], // key to match existing record
                [
                    'name' => $facility['name'],
                    'status' => $status,
                    'udise_status' => $facility['udise_status'],
                    'created_at' => $now,
                    'updated_at' => $now,
                ]
            );
        }
    }
}

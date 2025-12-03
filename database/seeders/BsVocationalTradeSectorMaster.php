<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class BsVocationalTradeSectorMaster extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = now();

        // id, name, delete_status
        $rows = [
            [61, 'AGRICULTURE', 'N'],
            [62, 'APPAREL', 'N'],
            [63, 'AUTOMOTIVE', 'N'],
            [64, 'BEAUTY & WELLNESS', 'N'],
            [67, 'ELECTRONICS', 'N'],
            [68, 'HEALTHCARE', 'N'],
            [69, 'IT-ITES', 'N'],
            [74, 'RETAIL', 'N'],
            [75, 'SECURITY', 'N'],
            [78, 'TOURISM & HOSPITALITY', 'N'],
            [0,  'NOT APPLICABLE', 'O'],
            [65, 'BANKING FINANCIAL SERVICES AND INSURANCE (BFSI)', 'O'],
            [70, 'LOGISTICS', 'O'],
            [71, 'CAPITAL ODS', 'O'],
            [72, 'MEDIA & ENTERTAINMENT', 'O'],
            [73, 'MULTI-SKILLING', 'O'],
            [76, 'SPORTS', 'O'],
            [79, 'LEATHER', 'O'],
            [81, 'IRON AND STEEL', 'O'],
            [82, 'POWER', 'N'],
            [77, 'TELECOM', 'O'],
            [80, 'PLUMBING', 'N'],
            [66, 'CONSTRUCTION', 'N'],
        ];

        $data = [];

        foreach ($rows as $row) {
            $data[] = [
                'id'         => $row[0],
                'name'       => $row[1],
                'status'     => $row[2] === 'N' ? 1 : 2, // N=1 active, O=2 inactive
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        DB::table('bs_vocational_trade_sector_master')->insert($data);

        // Reset autoincrement sequence
        DB::statement("
            SELECT setval(
                pg_get_serial_sequence('bs_vocational_trade_sector_master','id'),
                (SELECT MAX(id) FROM bs_vocational_trade_sector_master)
            );
        ");
    }
}

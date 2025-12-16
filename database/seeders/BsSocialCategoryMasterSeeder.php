<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BsSocialCategoryMasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
 public function run(): void
    {
        $now = Carbon::now();

        $rows = [
            [8, 'OBC-B', 80, 0, 0, null, 'N'],
            [7, 'OBC-A', 70, 0, 0, null, 'N'],
            [1, 'GENERAL', 10, 1, 1, 1, 'N'],
            [2, 'SC', 20, 1, 1, 2, 'N'],
            [3, 'ST', 30, 1, 1, 3, 'N'],
            [4, 'OBC', 40, 1, 1, 4, 'N'],
            [5, 'ORC', 50, 0, 1, 5, 'N'],
            [6, 'OTHERS', 60, 0, 1, 6, 'N'],
        ];

        $data = [];

        foreach ($rows as $r) {
            $data[] = [
                'id'                     => $r[0],
                'name'                   => $r[1],
                'rank'                   => $r[2],
                'udise_active_status'    => $r[3],
                'udise_tch_active_status'=> $r[4],
                'udise_code'             => $r[5],
                'status'                 => $r[6] === 'N' ? 1 : 2,
                'created_at'             => $now,
                'updated_at'             => $now,
            ];
        }

        DB::table('bs_social_category_master')->insert($data);

        // Reset sequence
        DB::statement("
            SELECT setval(
                pg_get_serial_sequence('bs_social_category_master', 'id'),
                (SELECT MAX(id) FROM bs_social_category_master)
            );
        ");
    }
}

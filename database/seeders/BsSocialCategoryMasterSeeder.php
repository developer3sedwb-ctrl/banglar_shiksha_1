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

        $categories = [
            ['name' => 'GENERAL', 'rank' => 10, 'udise_active_status' => 1, 'udise_tch_active_status' => 1, 'udise_code' => 1],
            ['name' => 'SC', 'rank' => 20, 'udise_active_status' => 1, 'udise_tch_active_status' => 1, 'udise_code' => 2],
            ['name' => 'ST', 'rank' => 30, 'udise_active_status' => 1, 'udise_tch_active_status' => 1, 'udise_code' => 3],
            ['name' => 'OBC', 'rank' => 40, 'udise_active_status' => 1, 'udise_tch_active_status' => 1, 'udise_code' => 4],
            ['name' => 'OTHERS', 'rank' => 50, 'udise_active_status' => 1, 'udise_tch_active_status' => 1, 'udise_code' => 5],
            ['name' => 'NOT APPLICABLE', 'rank' => 60, 'udise_active_status' => 0, 'udise_tch_active_status' => 0, 'udise_code' => 0],
        ];

        $data = array_map(fn($item) => [
            'name' => $item['name'],
            'rank' => $item['rank'],
            'udise_active_status' => $item['udise_active_status'],
            'udise_tch_active_status' => $item['udise_tch_active_status'],
            'udise_code' => $item['udise_code'],
            'status' => 1,
            'created_at' => $now,
            'updated_at' => $now,
        ], $categories);

        DB::table('bs_social_category_master')->insert($data);
    }
}

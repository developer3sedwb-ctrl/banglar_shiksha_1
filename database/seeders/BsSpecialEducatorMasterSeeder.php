<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BsSpecialEducatorMasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        $items = [
            ['name' => 'DEDICATED', 'rank' => 10],
            ['name' => 'CLUSTER LEVEL', 'rank' => 20],
            ['name' => 'NO', 'rank' => 30],
        ];

        $data = array_map(fn($it) => [
            'name' => $it['name'],
            'rank' => $it['rank'],
            'status' => 1,
            'created_at' => $now,
            'updated_at' => $now,
        ], $items);

        DB::table('bs_special_educator_master')->insert($data);
    }
}

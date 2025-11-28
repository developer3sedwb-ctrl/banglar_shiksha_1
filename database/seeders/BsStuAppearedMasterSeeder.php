<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BsStuAppearedMasterSeeder extends Seeder
       
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        $items = [
            ['name' => 'Promoted/Passed', 'rank' => 1],
            ['name' => 'Promoted/Passed with grace', 'rank' => 2],
            ['name' => 'Detained/Repeater/Not Passed', 'rank' => 3],
            ['name' => 'Promoted/Passed without Examination', 'rank' => 4],
            ['name' => 'Repeter by choice', 'rank' => 5],
        ];

        $data = array_map(fn($it) => [
            'name' => $it['name'],
            'rank' => $it['rank'],
            'status' => 1,
            'created_at' => $now,
            'updated_at' => $now,
        ], $items);

        DB::table('bs_stu_appeared_master')->insert($data);
    }
}

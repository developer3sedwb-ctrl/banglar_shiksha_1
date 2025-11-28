<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BsBoardCouncilMasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $boardCouncils = [
            ['name' => 'WBBSE'],
            [
                'name' => 'WBBME'
            ],
            [
                'name' => 'CBSE'
            ],
            [
                'name' => 'CISCE'
            ],
            [
                'name' => 'WBSCTVESD'
            ],
            [
                'name' => 'WBCHSE'
            ],
        ];

        foreach ($boardCouncils as $board) {
            DB::table('bs_board_council_master')->insert([
                'name' => $board['name'],
                'status' => 1,
                'created_at' => Carbon::Now(),
                'updated_at' => Carbon::Now()
            ]);
        }
    }
}

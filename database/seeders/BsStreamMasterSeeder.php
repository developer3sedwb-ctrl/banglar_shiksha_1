<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BsStreamMasterSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        $streams = [
            ['name' => 'ARTS', 'rank' => 10],
            ['name' => 'SCIENCE', 'rank' => 20],
            ['name' => 'COMMERCE', 'rank' => 30],
            ['name' => 'VOCATIONAL', 'rank' => 40],
            ['name' => 'OTHER STREAMS', 'rank' => 50],
            ['name' => 'NOT APPLICABLE', 'rank' => 60],
        ];

        $data = array_map(fn($stream) => [
            'name' => $stream['name'],
            'created_at' => $now,
            'updated_at' => $now,
        ], $streams);

        DB::table('bs_stream_master')->insert($data);
    }
}

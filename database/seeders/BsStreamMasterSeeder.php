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
            ['id' => 1,'name' => 'ARTS'],
            ['id' => 2,'name' => 'SCIENCE'],
            ['id' => 2,'name' => 'COMMERCE'],
            ['id' => 4,'name' => 'VOCATIONAL'],
            ['id' => 6,'name' => 'OTHER STREAMS'],
            ['id' => 999,'name' => 'NOT APPLICABLE'],
        ];

        $data = array_map(fn($stream) => [
            'id' => $stream['id'],
            'name' => $stream['name'],
            'created_at' => $now,
            'updated_at' => $now,
        ], $streams);

        DB::table('bs_stream_master')->insert($data);
    }
}

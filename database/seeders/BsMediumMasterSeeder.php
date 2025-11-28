<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class BsMediumMasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();
        $data = [
            ['id' => 1,  'name' => 'BENGALI',         'created_at' => $now, 'updated_at' => $now],
            ['id' => 2,  'name' => 'ASSAMESE',        'created_at' => $now, 'updated_at' => $now],
            ['id' => 3,  'name' => 'GUJARATI',        'created_at' => $now, 'updated_at' => $now],
            ['id' => 4,  'name' => 'HINDI',           'created_at' => $now, 'updated_at' => $now],
            ['id' => 5,  'name' => 'KANNADA',         'created_at' => $now, 'updated_at' => $now],
            ['id' => 6,  'name' => 'KASHMIRI',        'created_at' => $now, 'updated_at' => $now],
            ['id' => 7,  'name' => 'KONKANI',         'created_at' => $now, 'updated_at' => $now],
            ['id' => 8,  'name' => 'MALAYALAM',       'created_at' => $now, 'updated_at' => $now],
            ['id' => 9,  'name' => 'MANIPURI',        'created_at' => $now, 'updated_at' => $now],
            ['id' => 10, 'name' => 'MARATHI',         'created_at' => $now, 'updated_at' => $now],
            ['id' => 11, 'name' => 'NEPALI',          'created_at' => $now, 'updated_at' => $now],
            ['id' => 12, 'name' => 'ORIYA',           'created_at' => $now, 'updated_at' => $now],
            ['id' => 13, 'name' => 'PUNJABI',         'created_at' => $now, 'updated_at' => $now],
            ['id' => 14, 'name' => 'SANSKRIT',        'created_at' => $now, 'updated_at' => $now],
            ['id' => 15, 'name' => 'SINDHI',          'created_at' => $now, 'updated_at' => $now],
            ['id' => 16, 'name' => 'TAMIL',           'created_at' => $now, 'updated_at' => $now],
            ['id' => 17, 'name' => 'TELUGU',          'created_at' => $now, 'updated_at' => $now],
            ['id' => 18, 'name' => 'URDU',            'created_at' => $now, 'updated_at' => $now],
            ['id' => 19, 'name' => 'ENGLISH',         'created_at' => $now, 'updated_at' => $now],
            ['id' => 20, 'name' => 'BODO',            'created_at' => $now, 'updated_at' => $now],
            ['id' => 22, 'name' => 'DOGRI',           'created_at' => $now, 'updated_at' => $now],
            ['id' => 30, 'name' => 'SANTHALI',        'created_at' => $now, 'updated_at' => $now],
            ['id' => 40, 'name' => 'MAITHILI',        'created_at' => $now, 'updated_at' => $now],
            ['id' => 41, 'name' => 'RAJBANSHI',       'created_at' => $now, 'updated_at' => $now],
            ['id' => 42, 'name' => 'KAMTAPURI',       'created_at' => $now, 'updated_at' => $now],
            ['id' => 99, 'name' => 'OTHER LANGUAGES', 'created_at' => $now, 'updated_at' => $now]
        ];

        DB::table('bs_medium_master')->insert($data);
    }
}

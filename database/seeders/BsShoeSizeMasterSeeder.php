<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class BsShoeSizeMasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $now = Carbon::now();

        $sizes = [
            'SIZE - 1',
            'SIZE - 2',
            'SIZE - 3',
            'SIZE - 4',
            'SIZE - 5',
            'SIZE - 6',
            'SIZE - 7',
            'SIZE - 8',
            'SIZE - 9',
            'SIZE - 10',
            'SIZE - 11',
            'SIZE - 12',
            'SIZE - 13'
        ];

        $data = array_map(fn($name) => [
            'name' => $name,
            'created_at' => $now,
            'updated_at' => $now
        ], $sizes);

        DB::table('bs_shoe_size_master')->insert($data);
    }
    
}

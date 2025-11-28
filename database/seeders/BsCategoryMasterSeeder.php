<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class BsCategoryMasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
public function run(): void
    {
        $categories = [
            [
                'id' => 1,
                'name' => 'PRIMARY ONLY WITH GRADES 1 TO 4/5',
                'status' => 1,
                'class_list' => json_encode(['1','2','3','4','5']),
            ],
            [
                'id' => 2,
                'name' => 'UPPER PRIMARY WITH GRADES 1 TO 8',
                'status' => 1,
                'class_list' => json_encode(['1','2','3','4','5','6','7','8']),
            ],
            [
                'id' => 3,
                'name' => 'HIGHER SECONDARY WITH GRADES 1 TO 12',
                'status' => 1,
                'class_list' => json_encode(['1','2','3','4','5','6','7','8','9','10','11','12']),
            ],
            [
                'id' => 4,
                'name' => 'UPPER PRIMARY ONLY WITH GRADES 5/6 TO 8',
                'status' => 1,
                'class_list' => json_encode(['5','6','7','8']),
            ],
            [
                'id' => 5,
                'name' => 'HIGHER SECONDARY WITH GRADES 5/6 TO 12',
                'status' => 1,
                'class_list' => json_encode(['5','6','7','8','9','10','11','12']),
            ],
            [
                'id' => 6,
                'name' => 'SECONDARY WITH GRADES 1 TO 10',
                'status' => 1,
                'class_list' => json_encode(['1','2','3','4','5','6','7','8','9','10']),
            ],
            [
                'id' => 7,
                'name' => 'SECONDARY WITH GRADES 5/6 TO 10',
                'status' => 1,
                'class_list' => json_encode(['5','6','7','8','9','10']),
            ],
            [
                'id' => 8,
                'name' => 'SECONDARY ONLY WITH GRADES 9 & 10',
                'status' => 1,
                'class_list' => json_encode(['9','10']),
            ],
            [
                'id' => 10,
                'name' => 'HIGHER SECONDARY WITH GRADES 9 TO 12',
                'status' => 1,
                'class_list' => json_encode(['9','10','11','12']),
            ],
            [
                'id' => 11,
                'name' => 'HIGHER SECONDARY ONLY WITH GRADES 11 & 12',
                'status' => 1,
                'class_list' => json_encode(['11','12']),
            ],
        ];

        DB::table('bs_category_master')->insert($categories);
    }
}

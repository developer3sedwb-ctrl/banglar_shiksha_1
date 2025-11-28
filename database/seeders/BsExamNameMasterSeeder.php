<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class BsExamNameMasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $now = Carbon::now();
        DB::table('bs_exam_name_master')->insert([
            ['board_council_id' => 4, 'class_id' => 10, 'name' => 'ICSE',      'pass_marks' => null, 'total_marks' => null, 'created_at' =>$now, 'updated_at' =>$now],
            ['board_council_id' => 4, 'class_id' => 12, 'name' => 'ISC',       'pass_marks' => null, 'total_marks' => null, 'created_at' =>$now, 'updated_at' =>$now],
            ['board_council_id' => 1, 'class_id' => 10, 'name' => 'MP EXAM',   'pass_marks' => 175,  'total_marks' => 700, 'created_at' =>$now, 'updated_at' =>$now],
            ['board_council_id' => 3, 'class_id' => 10, 'name' => 'MP EXAM',   'pass_marks' => 175,  'total_marks' => 700, 'created_at' =>$now, 'updated_at' =>$now],
            ['board_council_id' => 5, 'class_id' => 10, 'name' => 'MP EXAM',   'pass_marks' => 175,  'total_marks' => 700, 'created_at' =>$now, 'updated_at' =>$now],
            ['board_council_id' => 6, 'class_id' => 10, 'name' => 'MP EXAM',   'pass_marks' => 175,  'total_marks' => 700, 'created_at' =>$now, 'updated_at' =>$now],
            ['board_council_id' => 1, 'class_id' => 12, 'name' => 'HS EXAM',   'pass_marks' => 150,  'total_marks' => 500, 'created_at' =>$now, 'updated_at' =>$now],
            ['board_council_id' => 3, 'class_id' => 12, 'name' => 'HS EXAM',   'pass_marks' => 150,  'total_marks' => 500, 'created_at' =>$now, 'updated_at' =>$now],
            ['board_council_id' => 5, 'class_id' => 12, 'name' => 'HS EXAM',   'pass_marks' => 150,  'total_marks' => 500, 'created_at' =>$now, 'updated_at' =>$now],
            ['board_council_id' => 6, 'class_id' => 12, 'name' => 'HS EXAM',   'pass_marks' => 150,  'total_marks' => 500, 'created_at' =>$now, 'updated_at' =>$now],
            ['board_council_id' => 2, 'class_id' => 10, 'name' => 'HM EXAM',   'pass_marks' => 200,  'total_marks' => 800, 'created_at' =>$now, 'updated_at' =>$now],
            ['board_council_id' => 2, 'class_id' => 10, 'name' => 'ALIM EXAM', 'pass_marks' => 227,  'total_marks' => 900, 'created_at' =>$now, 'updated_at' =>$now],
            ['board_council_id' => 2, 'class_id' => 12, 'name' => 'FIZIL EXAM','pass_marks' => 180,  'total_marks' => 600, 'created_at' =>$now, 'updated_at' =>$now],
        ]);
    }
}

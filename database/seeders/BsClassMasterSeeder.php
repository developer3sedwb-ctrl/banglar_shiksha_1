<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class BsClassMasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $now = Carbon::now();
        DB::table('bs_class_master')->insert([
            ['id'=>'-2','name' => 'NURSARY',        'created_at' => $now, 'updated_at' => $now],
            ['id'=>'-1','name' => 'LKG',            'created_at' => $now, 'updated_at' => $now],
            ['id'=>'0','name' => 'PRE PRIMARY',    'created_at' => $now, 'updated_at' => $now],
            ['id'=>'1','name' => 'CLASS I',        'created_at' => $now, 'updated_at' => $now],
            ['id'=>'2','name' => 'CLASS II',       'created_at' => $now, 'updated_at' => $now],
            ['id'=>'3','name' => 'CLASS III',      'created_at' => $now, 'updated_at' => $now],
            ['id'=>'4','name' => 'CLASS IV',       'created_at' => $now, 'updated_at' => $now],
            ['id'=>'5','name' => 'CLASS V',        'created_at' => $now, 'updated_at' => $now],
            ['id'=>'6','name' => 'CLASS VI',       'created_at' => $now, 'updated_at' => $now],
            ['id'=>'7','name' => 'CLASS VII',      'created_at' => $now, 'updated_at' => $now],
            ['id'=>'8','name' => 'CLASS VIII',     'created_at' => $now, 'updated_at' => $now],
            ['id'=>'9','name' => 'CLASS IX',       'created_at' => $now, 'updated_at' => $now],
            ['id'=>'10','name' => 'CLASS X',        'created_at' => $now, 'updated_at' => $now],
            ['id'=>'11','name' => 'CLASS XI',       'created_at' => $now, 'updated_at' => $now],
            ['id'=>'12','name' => 'CLASS XII',      'created_at' => $now, 'updated_at' => $now]
        ]);
    }
}

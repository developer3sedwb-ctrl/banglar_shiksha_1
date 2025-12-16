<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class BsLanguageMasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $languages = [
            ['id'=> 1,'name' => 'BENGALI'],
            ['id'=> 2,'name' => 'ENGLISH'],
            ['id'=> 3,'name' => 'HINDI'],
            ['id'=> 4,'name' => 'NEPALI'],
            ['id'=> 5,'name' => 'URDU'],
            ['id'=> 6,'name' => 'ODIA'],
            ['id'=> 8,'name' => 'SANTHALI'],
            ['id'=> 7,'name' => 'GUJARATI']
        ];
        foreach ($languages as $language) {
            DB::table('bs_language_master')->insert([
                'id' => $language['id'],
                'name' => $language['name'],
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }

    }
}

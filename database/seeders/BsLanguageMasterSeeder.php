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
            ['name' => 'BENGALI'],
            ['name' => 'ENGLISH'],
            ['name' => 'HINDI'],
            ['name' => 'NEPALI'],
            ['name' => 'URDU'],
            ['name' => 'ODIA'],
            ['name' => 'SANTHALI'],
            ['name' => 'GUJARATI']
        ];
        foreach ($languages as $language) {
            DB::table('bs_language_master')->insert([
                'name' => $language['name'],
                'status' => $language['status'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }

    }
}

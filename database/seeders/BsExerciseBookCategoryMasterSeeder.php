<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class BsExerciseBookCategoryMasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $now = Carbon::now();
        DB::table('bs_exercise_book_category_master')->insert([
            ['name' => 'Category PP - X', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Category XI - XII', 'created_at' => $now, 'updated_at' => $now]
          
        ]);
    }
}

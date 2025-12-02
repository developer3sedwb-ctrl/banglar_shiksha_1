<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class BsNameAndCodeStateScholershipsMaster extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         DB::table('bs_name_and_code_of_state_scholarships_master')->insert([
            ['id' => 1, 'name' => 'Kanyashree 1', 'created_at'=>now(), 'updated_at' => now()],
            ['id' => 2, 'name' => 'Kanyashree 2', 'created_at'=>now(), 'updated_at' => now()],
            ['id' => 3, 'name' => 'Aikyashree Pre-Matric Scholarship', 'created_at'=>now(), 'updated_at' => now()],
            ['id' => 4, 'name' => 'Shikshashree', 'created_at'=>now(), 'updated_at' => now()],
            ['id' => 5, 'name' => 'SC ST Scholarship for hosteller', 'created_at'=>now(), 'updated_at' => now()],
            ['id' => 6, 'name' => 'Pre-Matric Scholarship for OBC Merit cum Means', 'created_at'=>now(), 'updated_at' => now()],
            ['id' => 7, 'name' => 'SC ST Scholarship for Class V-XII Students', 'created_at'=>now(), 'updated_at' => now()],
            ['id' => 8, 'name' => 'Post Matric Scholarship for ST Students', 'created_at'=>now(), 'updated_at' => now()],
            ['id' => 9, 'name' => 'Post Matric Scholarship for SC Students', 'created_at'=>now(), 'updated_at' => now()],
            ['id' => 10, 'name' => 'Post Matric Scholarship for OBC Students', 'created_at'=>now(), 'updated_at' => now()],
            ['id' => 11, 'name' => 'Vidyasagar Science Olympiad', 'created_at'=>now(), 'updated_at' => now()],
            ['id' => 12, 'name' => 'CS Pre-Matric Scholarship for SC Students of Class IX & X', 'created_at'=>now(), 'updated_at' => now()],
            ['id' => 13, 'name' => 'Swami Vivekananda Merit Cum Means Scholarship', 'created_at'=>now(), 'updated_at' => now()],
            ['id' => 14, 'name' => 'Aikyashree Post Matric Scholarship', 'created_at'=>now(), 'updated_at' => now()],
            ['id' => 15, 'name' => 'Aikyashree Talent Support Stipend', 'created_at'=>now(), 'updated_at' => now()],
            ['id' => 16, 'name' => 'Aikyashree Swami Vivekananda Merit Cum Means Scholarship', 'created_at'=>now(), 'updated_at' => now()],
            ['id' => 99, 'name' => 'NOT APPLICABLE', 'created_at'=>now(), 'updated_at' => now()]
        ]);
    }
}

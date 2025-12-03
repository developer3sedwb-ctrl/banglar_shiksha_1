<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class BsNameAndCodeCentralScholershipsMaster extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('bs_name_and_code_of_central_scholarships_master')->insert([
            ['id' => 1, 'name' => 'Pre Matric Scholarships Scheme for Minorities (MoMA)', 'created_at'=>now(), 'updated_at' => now()],
            ['id' => 2, 'name' => 'Post Matric Scholarships Scheme for Minorities (MoMA)', 'created_at'=>now(), 'updated_at' => now()],
            ['id' => 3, 'name' => 'BEGUM HAZRAT MAHAL NATIONAL SCHOLARSHIP (MoMA)', 'created_at'=>now(), 'updated_at' => now()],
            ['id' => 4, 'name' => 'Pre-matric Scholarship for Students with Disabilities (DEPwD)', 'created_at'=>now(), 'updated_at' => now()],
            ['id' => 5, 'name' => 'Post-matric Scholarship for Students with Disabilities (DEPwD)', 'created_at'=>now(), 'updated_at' => now()],
            ['id' => 6, 'name' => 'Post Matric Scholarship for SC students (All States) (MoSJE)', 'created_at'=>now(), 'updated_at' => now()],
            ['id' => 7, 'name' => 'Pre Matric Scholarship for SC students for Class IX and X (All States) (MoSJE)', 'created_at'=>now(), 'updated_at' => now()],
            ['id' => 8, 'name' => 'Financial Assistance for Education of the Wards of Beedi/Cine/IOMC/LSDM Workers - Post-Matric (MoLE)', 'created_at'=>now(), 'updated_at' => now()],
            ['id' => 9, 'name' => 'Financial Assistance for Education of the Wards of Beedi/Cine/IOMC/LSDM Workers - Pre-Matric (MoLE)', 'created_at'=>now(), 'updated_at' => now()],
            ['id' => 10, 'name' => 'National Means Cum Merit Scholarship (DoSEL)', 'created_at'=>now(), 'updated_at' => now()],
            ['id' => 11, 'name' => "Prime Minister's Scholarship Scheme For Central Armed Police Forces And Assam Rifles", 'created_at'=>now(), 'updated_at' => now()],
            ['id' => 12, 'name' => 'Prime Minister’s Scholarship Scheme for wards of States/UTs Police Personnel Martyred during Terror/Naxal Attacks', 'created_at'=>now(), 'updated_at' => now()],
            ['id' => 13, 'name' => "Prime Minister's Scholarship Scheme For RPF/RPSF", 'created_at'=>now(), 'updated_at' => now()],
            ['id' => 14, 'name' => 'Financial Support to the students of NER for Higher Professional Courses (NEC MERIT SCHOLARSHIP)', 'created_at'=>now(), 'updated_at' => now()],
            ['id' => 15, 'name' => 'Other Central Scholarships', 'created_at'=>now(), 'updated_at' => now()],
        ]);
    }
}

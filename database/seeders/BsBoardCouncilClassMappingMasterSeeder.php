<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class BsBoardCouncilClassMappingMasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $data = [
            ['mapping_code_pk' =>1 ,'board_council_code_fk' =>1 ,'class_code_fk' => 10],
            ['mapping_code_pk' =>2 ,'board_council_code_fk' =>2 ,'class_code_fk' => 10],
            ['mapping_code_pk' =>3 ,'board_council_code_fk' =>2 ,'class_code_fk' => 12],
            ['mapping_code_pk' =>4 ,'board_council_code_fk' =>3 ,'class_code_fk' => 10],
            ['mapping_code_pk' =>5 ,'board_council_code_fk' =>3 ,'class_code_fk' => 12],
            ['mapping_code_pk' =>6 ,'board_council_code_fk' =>4 ,'class_code_fk' => 10],
            ['mapping_code_pk' =>7 ,'board_council_code_fk' =>4 ,'class_code_fk' => 12],
            ['mapping_code_pk' =>8 ,'board_council_code_fk' =>5 ,'class_code_fk' => 10],
            ['mapping_code_pk' =>9 ,'board_council_code_fk' =>5 ,'class_code_fk' => 12],
            ['mapping_code_pk' =>10 ,'board_council_code_fk' =>6 ,'class_code_fk' =>12]
            
        ];
        foreach ($data as $mapping) {
            DB::table('bs_board_council_class_mapping_master')->insert([
                'id' => $mapping['mapping_code_pk'],
                'board_council_code_fk' => $mapping['board_council_code_fk'],
                'class_code_fk' => $mapping['class_code_fk'],
                'status' => 1,
                'created_at' => Carbon::Now(),
                'updated_at' => Carbon::Now()
            ]);
        }
    }
}

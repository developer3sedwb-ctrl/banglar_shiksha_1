<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class BsDistrictParliamentaryMasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $rows = [
            ['district_code_fk' => 15, 'parliamentary_code_fk' => 2],
            ['district_code_fk' => 4, 'parliamentary_code_fk' => 36],
            ['district_code_fk' => 4, 'parliamentary_code_fk' => 37],
            ['district_code_fk' => 19, 'parliamentary_code_fk' => 41],
            ['district_code_fk' => 19, 'parliamentary_code_fk' => 42],
            ['district_code_fk' => 6, 'parliamentary_code_fk' => 1],
            ['district_code_fk' => 6, 'parliamentary_code_fk' => 2],
            ['district_code_fk' => 6, 'parliamentary_code_fk' => 3],
            ['district_code_fk' => 7, 'parliamentary_code_fk' => 6],
            ['district_code_fk' => 21, 'parliamentary_code_fk' => 4],
            ['district_code_fk' => 1, 'parliamentary_code_fk' => 27],
            ['district_code_fk' => 1, 'parliamentary_code_fk' => 28],
            ['district_code_fk' => 1, 'parliamentary_code_fk' => 29],
            ['district_code_fk' => 20, 'parliamentary_code_fk' => 27],
            ['district_code_fk' => 20, 'parliamentary_code_fk' => 25],
            ['district_code_fk' => 20, 'parliamentary_code_fk' => 26],
            ['district_code_fk' => 2, 'parliamentary_code_fk' => 2],
            ['district_code_fk' => 2, 'parliamentary_code_fk' => 3],
            ['district_code_fk' => 8, 'parliamentary_code_fk' => 33],
            ['district_code_fk' => 24, 'parliamentary_code_fk' => 4],
            ['district_code_fk' => 11, 'parliamentary_code_fk' => 24],
            ['district_code_fk' => 11, 'parliamentary_code_fk' => 23],
            ['district_code_fk' => 11, 'parliamentary_code_fk' => 22],
            ['district_code_fk' => 9, 'parliamentary_code_fk' => 8],
            ['district_code_fk' => 9, 'parliamentary_code_fk' => 7],
            ['district_code_fk' => 5, 'parliamentary_code_fk' => 8],
            ['district_code_fk' => 5, 'parliamentary_code_fk' => 10],
            ['district_code_fk' => 5, 'parliamentary_code_fk' => 9],
            ['district_code_fk' => 5, 'parliamentary_code_fk' => 11],
            ['district_code_fk' => 17, 'parliamentary_code_fk' => 11],
            ['district_code_fk' => 17, 'parliamentary_code_fk' => 12],
            ['district_code_fk' => 17, 'parliamentary_code_fk' => 13],
            ['district_code_fk' => 17, 'parliamentary_code_fk' => 14],
            ['district_code_fk' => 23, 'parliamentary_code_fk' => 14],
            ['district_code_fk' => 23, 'parliamentary_code_fk' => 17],
            ['district_code_fk' => 23, 'parliamentary_code_fk' => 15],
            ['district_code_fk' => 23, 'parliamentary_code_fk' => 18],
            ['district_code_fk' => 23, 'parliamentary_code_fk' => 16],
            ['district_code_fk' => 25, 'parliamentary_code_fk' => 40],
            ['district_code_fk' => 25, 'parliamentary_code_fk' => 39],
            ['district_code_fk' => 22, 'parliamentary_code_fk' => 29],
            ['district_code_fk' => 22, 'parliamentary_code_fk' => 32],
            ['district_code_fk' => 22, 'parliamentary_code_fk' => 33],
            ['district_code_fk' => 22, 'parliamentary_code_fk' => 34],
            ['district_code_fk' => 3, 'parliamentary_code_fk' => 37],
            ['district_code_fk' => 3, 'parliamentary_code_fk' => 38],
            ['district_code_fk' => 3, 'parliamentary_code_fk' => 39],
            ['district_code_fk' => 3, 'parliamentary_code_fk' => 41],
            ['district_code_fk' => 14, 'parliamentary_code_fk' => 30],
            ['district_code_fk' => 14, 'parliamentary_code_fk' => 31],
            ['district_code_fk' => 14, 'parliamentary_code_fk' => 32],
            ['district_code_fk' => 14, 'parliamentary_code_fk' => 34],
            ['district_code_fk' => 13, 'parliamentary_code_fk' => 33],
            ['district_code_fk' => 13, 'parliamentary_code_fk' => 35],
            ['district_code_fk' => 13, 'parliamentary_code_fk' => 36],
            ['district_code_fk' => 12, 'parliamentary_code_fk' => 4],
            ['district_code_fk' => 18, 'parliamentary_code_fk' => 22],
            ['district_code_fk' => 18, 'parliamentary_code_fk' => 19],
            ['district_code_fk' => 18, 'parliamentary_code_fk' => 20],
            ['district_code_fk' => 10, 'parliamentary_code_fk' => 5],
            ['district_code_fk' => 10, 'parliamentary_code_fk' => 4],
            ['district_code_fk' => 10, 'parliamentary_code_fk' => 6],
            ['district_code_fk' => 18, 'parliamentary_code_fk' => 21],
            // Add more district-parliamentary mappings as needed
        ];
        $data = [];
        $now = Carbon::now();
        foreach ($rows as $r) {
            $data[] = [
                'district_code_fk'       => $r['district_code_fk'],
                'parliamentary_code_fk'  => $r['parliamentary_code_fk'],
                'created_at'             => $now,
                'updated_at'             => $now
            ];
        }

        DB::table('bs_udise_school_type_master')->insert($data);
    }
}

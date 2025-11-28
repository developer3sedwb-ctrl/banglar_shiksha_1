<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class BsManagementMasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();
        $rows = [
            ['id' => 1,'name' => 'Department of Education',                         'created_at' => $now, 'updated_at' => $now],
            ['id' => 2,'name' => 'Tribal Welfare Department',                       'created_at' => $now, 'updated_at' => $now],
            ['id' => 3,'name' => 'Local Body',                                      'created_at' => $now, 'updated_at' => $now],
            ['id' => 4,'name' => 'Government Aided',                                'created_at' => $now, 'updated_at' => $now],
            ['id' => 6,'name' => 'Other State Govt. Managed',                       'created_at' => $now, 'updated_at' => $now],
            ['id' => 89,'name' => 'Minority affairs Dept.',                          'created_at' => $now, 'updated_at' => $now],
            ['id' => 15,'name' => 'Govt. Sponsored',                                 'created_at' => $now, 'updated_at' => $now],
            ['id' => 13,'name' => 'Madrasa Siksha Kendra',                           'created_at' => $now, 'updated_at' => $now],
            ['id' => 16,'name' => 'Mass Education',                                  'created_at' => $now, 'updated_at' => $now],
            ['id' => 90,'name' => 'Social welfare Department',                       'created_at' => $now, 'updated_at' => $now],
            ['id' => 97,'name' => 'Madrasa Aided (Recognized)',                      'created_at' => $now, 'updated_at' => $now],
            ['id' => 5,'name' => 'Private Unaided (Recognized)',                    'created_at' => $now, 'updated_at' => $now],
            ['id' => 99,'name' => 'Madrasa Private Unaided Recognized',              'created_at' => $now, 'updated_at' => $now],
            ['id' => 92,'name' => 'Kendriya Vidyalaya',                              'created_at' => $now, 'updated_at' => $now],
            ['id' => 93,'name' => 'Jawahar Navodaya Vidyalaya',                      'created_at' => $now, 'updated_at' => $now],
            ['id' => 94,'name' => 'Sainik School',                                   'created_at' => $now, 'updated_at' => $now],
            ['id' => 95,'name' => 'Railway School',                                  'created_at' => $now, 'updated_at' => $now],
            ['id' => 96,'name' => 'Central Tibetan School',                          'created_at' => $now, 'updated_at' => $now],
            ['id' => 91,'name' => 'Ministry of Labour',                              'created_at' => $now, 'updated_at' => $now],
            ['id' => 101,'name' => 'Other Central Govt. / PSU Schools',               'created_at' => $now, 'updated_at' => $now],
            ['id' => 8,'name' => 'Unrecognized',                                    'created_at' => $now, 'updated_at' => $now],
            ['id' => 98,'name' => 'Madrasa Unrecognized',                            'created_at' => $now, 'updated_at' => $now],
            ['id' => 12,'name' => 'SSKs & MSKs',                                     'created_at' => $now, 'updated_at' => $now],
        ];

        $now = Carbon::now();

        $insert = array_map(function ($r) use ($now) {
            $created = isset($r['created_at']) ? Carbon::parse($r['created_at']) : $now;
            return [
                'id'         => $r['id'],
                'name'       => $r['name'],
                'created_at' => $created,
                'updated_at' => $created,
            ];
        }, $rows);

        DB::table('bs_management_master')->insert($insert);
    }
}

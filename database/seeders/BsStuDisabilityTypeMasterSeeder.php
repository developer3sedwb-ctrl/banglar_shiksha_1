<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BsStuDisabilityTypeMasterSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        $items = [
            ['name' => 'BLINDNESS', 'rank' => 20, 'udise_active_status' => null, 'udise_code' => null],
            ['name' => 'LOW-VISION', 'rank' => 30, 'udise_active_status' => null, 'udise_code' => null],
            ['name' => 'HEARING IMPAIRMENT (DEAF AND HARD OF HEARING)', 'rank' => 40, 'udise_active_status' => 1, 'udise_code' => 5],
            ['name' => 'SPEECH AND LANGUAGE DISABILITY', 'rank' => 50, 'udise_active_status' => null, 'udise_code' => null],
            ['name' => 'LOCOMOTOR DISABILITY', 'rank' => 60, 'udise_active_status' => 1, 'udise_code' => 2],
            ['name' => 'MENTAL ILLNESS', 'rank' => 70, 'udise_active_status' => null, 'udise_code' => null],
            ['name' => 'SPECIFIC LEARNING DISABILITIES', 'rank' => 80, 'udise_active_status' => null, 'udise_code' => null],
            ['name' => 'CEREBRAL PALSY', 'rank' => 90, 'udise_active_status' => null, 'udise_code' => null],
            ['name' => 'AUTISM SPECTRUM DISORDER', 'rank' => 100, 'udise_active_status' => null, 'udise_code' => null],
            ['name' => 'MULTIPLE DISABILITIES INCLUDING DEAF BLINDNESS', 'rank' => 110, 'udise_active_status' => null, 'udise_code' => null],
            ['name' => 'LEPROSY CURED PERSONS', 'rank' => 120, 'udise_active_status' => null, 'udise_code' => null],
            ['name' => 'DWARFISM', 'rank' => 130, 'udise_active_status' => null, 'udise_code' => null],
            ['name' => 'INTELLECTUAL DISABILITY', 'rank' => 140, 'udise_active_status' => null, 'udise_code' => null],
            ['name' => 'MUSCULAR DYSTROPHY', 'rank' => 150, 'udise_active_status' => null, 'udise_code' => null],
            ['name' => 'CHRONIC NEUROLOGICAL CONDITIONS', 'rank' => 160, 'udise_active_status' => null, 'udise_code' => null],
            ['name' => 'MULTIPLE SCLEROSIS', 'rank' => 170, 'udise_active_status' => null, 'udise_code' => null],
            ['name' => 'THALASSEMIA', 'rank' => 180, 'udise_active_status' => null, 'udise_code' => null],
            ['name' => 'HEMOPHILIA', 'rank' => 190, 'udise_active_status' => null, 'udise_code' => null],
            ['name' => 'SICKLE CELL DISEASE', 'rank' => 200, 'udise_active_status' => null, 'udise_code' => null],
            ['name' => 'PARKINSONS DISEASE', 'rank' => 220, 'udise_active_status' => null, 'udise_code' => null],
            ['name' => 'ACID ATTACK VICTIM', 'rank' => 210, 'udise_active_status' => null, 'udise_code' => null],
            ['name' => 'NOT APPLICABLE', 'rank' => 10, 'udise_active_status' => 1, 'udise_code' => 1],
            ['name' => 'OTHERS', 'rank' => null, 'udise_active_status' => 1, 'udise_code' => 4],
            ['name' => 'VISUAL', 'rank' => null, 'udise_active_status' => 1, 'udise_code' => 3],
            ['name' => 'SANITATION & HYGIENE', 'rank' => null, 'udise_active_status' => null, 'udise_code' => null],
        ];

        $data = array_map(fn($it) => [
            'name' => $it['name'],
            'rank' => $it['rank'],
            'udise_active_status' => $it['udise_active_status'],
            'udise_code' => $it['udise_code'],
            'status' => 1,
            'created_at' => $now,
            'updated_at' => $now,
        ], $items);

        DB::table('bs_stu_disability_type_master')->insert($data);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class BsParliamentaryMasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        $data = [
            ['id' => 30, 'name' => 'DARJEELING'],
            ['id' => 37, 'name' => 'BANKURA'],
            ['id' => 18, 'name' => 'SERAMPORE'],
            ['id' => 11, 'name' => 'JALPAIGURI'],
            ['id' => 14, 'name' => 'TAMLUK'],
            ['id' => 10, 'name' => 'MURSHIDABAD'],
            ['id' => 2,  'name' => 'DIAMOND HARBOUR'],
            ['id' => 7,  'name' => 'ARAMBAGH'],
            ['id' => 44, 'name' => 'RANAGHAT'],
            ['id' => 5,  'name' => 'BAHARAMPUR'],
            ['id' => 35, 'name' => 'BISHNUPUR'],
            ['id' => 8,  'name' => 'BALURGHAT'],
            ['id' => 25, 'name' => 'COOCH BEHAR'],
            ['id' => 29, 'name' => 'COOCH BEHAR'],
            ['id' => 21, 'name' => 'BARDHAMAN-DURGAPUR'],
            ['id' => 17, 'name' => 'BARASAT'],
            ['id' => 32, 'name' => 'MEDINIPUR'],
            ['id' => 23, 'name' => 'RAIGANJ'],
            ['id' => 4,  'name' => 'GHATAL'],
            ['id' => 33, 'name' => 'BIRBHUM'],
            ['id' => 6,  'name' => 'BOLPUR'],
            ['id' => 13, 'name' => 'ALIPURDUARS'],
            ['id' => 45, 'name' => 'KRISHNANAGAR'],
            ['id' => 27, 'name' => 'JAYNAGAR'],
            ['id' => 9,  'name' => 'ASANSOL'],
            ['id' => 31, 'name' => 'ULUBERIA'],
            ['id' => 36, 'name' => 'KANTHI'],
            ['id' => 42, 'name' => 'BARDHAMAN'],
            ['id' => 3,  'name' => 'MALDAHA DAKSHI'],
            ['id' => 40, 'name' => 'JADAVPUR'],
            ['id' => 43, 'name' => 'TAMLUK'],
            ['id' => 1,  'name' => 'JANGIPUR'],
            ['id' => 46, 'name' => 'JHARGRAM'],
            ['id' => 15, 'name' => 'BARRACKPUR'],
            ['id' => 22, 'name' => 'MALDAHA UTTAR'],
            ['id' => 28, 'name' => 'HOOGHLY'],
            ['id' => 16, 'name' => 'BASIRHAT'],
            ['id' => 39, 'name' => 'KOLKATA UTTAR'],
            ['id' => 24, 'name' => 'PURULIA'],
            ['id' => 41, 'name' => 'ULUBERIA'],
            ['id' => 12, 'name' => 'MATHURAPUR'],
            ['id' => 20, 'name' => 'BONGAO'],
            ['id' => 38, 'name' => 'KOLKATA DAKSHI'],
            ['id' => 26, 'name' => 'HOWRAH'],
            ['id' => 19, 'name' => 'BONGAO'],
            ['id' => 34, 'name' => 'DUM DUM'],
        ];

        DB::table('bs_parliamentary_master')->truncate();

        DB::table('bs_parliamentary_master')->insert(
            collect($data)->map(function ($row) use ($now) {
                return [
                    'id'         => $row['id'],
                    'name'       => $row['name'],
                    'status'     => 1,
                    'created_at' => $now,
                    'updated_at' => $now                
                ];
            })->toArray()
        );
    }
}

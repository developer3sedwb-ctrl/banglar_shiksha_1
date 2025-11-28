<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class BsDistrictMasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
     $districts = [
    ['state_id' => 1, 'previous_id' => 16, 'schcd' => '1909', 'name' => 'BARDDHAMAN', 'district_type' => 1, 'ddo_code' => null, 'treasury_code' => '', 'status' => 5],
    ['state_id' => 1, 'previous_id' => 1, 'schcd' => '1912', 'name' => 'HOOGHLY', 'district_type' => 1, 'ddo_code' => 'HGBEDS003', 'treasury_code' => 'HGB', 'status' => 1],
    ['state_id' => 1, 'previous_id' => 2, 'schcd' => '1902', 'name' => 'JALPAIGURI', 'district_type' => 1, 'ddo_code' => 'JAAEDS001', 'treasury_code' => 'JAA', 'status' => 1],
    ['state_id' => 1, 'previous_id' => 3, 'schcd' => '1925', 'name' => 'PURBA BARDHAMAN', 'district_type' => 1, 'ddo_code' => 'BUAEDS001', 'treasury_code' => 'BUA', 'status' => 1],
    ['state_id' => 1, 'previous_id' => 4, 'schcd' => '1913', 'name' => 'BANKURA', 'district_type' => 1, 'ddo_code' => 'BAAEDS001', 'treasury_code' => 'BAA', 'status' => 1],
    ['state_id' => 1, 'previous_id' => 5, 'schcd' => '1907', 'name' => 'MURSHIDABAD', 'district_type' => 1, 'ddo_code' => 'MUBEDS002', 'treasury_code' => 'MUB', 'status' => 1],
    ['state_id' => 1, 'previous_id' => 6, 'schcd' => '1903', 'name' => 'COOCHBEHAR', 'district_type' => 1, 'ddo_code' => 'COAEDS001', 'treasury_code' => 'COA', 'status' => 1],
    ['state_id' => 1, 'previous_id' => 7, 'schcd' => '1905', 'name' => 'DAKSHIN DINAJPUR', 'district_type' => 1, 'ddo_code' => 'DDAEDS001', 'treasury_code' => 'DDA', 'status' => 1],
    ['state_id' => 1, 'previous_id' => 8, 'schcd' => '1923', 'name' => 'JHARGRAM', 'district_type' => 1, 'ddo_code' => 'MIEEDS001', 'treasury_code' => 'MIE', 'status' => 1],
    ['state_id' => 1, 'previous_id' => 9, 'schcd' => '1906', 'name' => 'MALDAH', 'district_type' => 1, 'ddo_code' => 'MDAEDP030', 'treasury_code' => 'MDA', 'status' => 1],
    ['state_id' => 1, 'previous_id' => 10, 'schcd' => '1904', 'name' => 'UTTAR DINAJPUR', 'district_type' => 1, 'ddo_code' => 'UDCEDS001', 'treasury_code' => 'UDC', 'status' => 1],
    ['state_id' => 1, 'previous_id' => 11, 'schcd' => '1917', 'name' => 'KOLKATA', 'district_type' => 1, 'ddo_code' => 'CACEDS703', 'treasury_code' => 'CAC', 'status' => 1],
    ['state_id' => 1, 'previous_id' => 12, 'schcd' => '1921', 'name' => 'SILIGURI', 'district_type' => 1, 'ddo_code' => 'DADEDS001', 'treasury_code' => 'DAD', 'status' => 1],
    ['state_id' => 1, 'previous_id' => 13, 'schcd' => '1914', 'name' => 'PURULIYA', 'district_type' => 1, 'ddo_code' => 'PUAEDS001', 'treasury_code' => 'PUA', 'status' => 1],
    ['state_id' => 1, 'previous_id' => 14, 'schcd' => '1919', 'name' => 'PURBA MEDINIPUR', 'district_type' => 1, 'ddo_code' => 'MIGEDS001', 'treasury_code' => 'MIG', 'status' => 1],
    ['state_id' => 1, 'previous_id' => 17, 'schcd' => '1910', 'name' => 'NADIA', 'district_type' => 1, 'ddo_code' => 'NAAEDS001', 'treasury_code' => 'NAA', 'status' => 1],
    ['state_id' => 1, 'previous_id' => 18, 'schcd' => '1918', 'name' => 'SOUTH  TWENTY FOUR PARGAN', 'district_type' => 1, 'ddo_code' => 'SPAEDS001', 'treasury_code' => 'SPA', 'status' => 1],
    ['state_id' => 1, 'previous_id' => 19, 'schcd' => '1908', 'name' => 'BIRBHUM', 'district_type' => 1, 'ddo_code' => 'BRAEDS001', 'treasury_code' => 'BRA', 'status' => 1],
    ['state_id' => 1, 'previous_id' => 20, 'schcd' => '1916', 'name' => 'HOWRAH', 'district_type' => 1, 'ddo_code' => 'HWBEDS001', 'treasury_code' => 'HWB', 'status' => 1],
    ['state_id' => 1, 'previous_id' => 22, 'schcd' => '1920', 'name' => 'PASCHIM MEDINIPUR', 'district_type' => 1, 'ddo_code' => 'MIAEDS001', 'treasury_code' => 'MIA', 'status' => 1],
    ['state_id' => 1, 'previous_id' => 23, 'schcd' => '1911', 'name' => 'NORTH TWENTY FOUR PARGANA', 'district_type' => 1, 'ddo_code' => 'NPAEDS001', 'treasury_code' => 'NPA', 'status' => 1],
    ['state_id' => 1, 'previous_id' => 25, 'schcd' => '1926', 'name' => 'PASCHIM BARDHAMAN', 'district_type' => 1, 'ddo_code' => 'BUDEDS003', 'treasury_code' => 'BUD', 'status' => 1],
    ['state_id' => 1, 'previous_id' => 15, 'schcd' => '1922', 'name' => 'ALIPURDUAR', 'district_type' => 1, 'ddo_code' => 'JACEDS001', 'treasury_code' => 'JAC', 'status' => 1],
    ['state_id' => 1, 'previous_id' => 99, 'schcd' => '1999', 'name' => 'BARRACKPUR', 'district_type' => 1, 'ddo_code' => 'NPCEDS002', 'treasury_code' => 'NPC', 'status' => 1],
    ['state_id' => 1, 'previous_id' => 21, 'schcd' => '1901', 'name' => 'DARJILING', 'district_type' => 1, 'ddo_code' => 'DAA000063', 'treasury_code' => 'DAA', 'status' => 1],
    ['state_id' => 1, 'previous_id' => 24, 'schcd' => '1924', 'name' => 'KALIMPONG', 'district_type' => 1, 'ddo_code' => 'DAA000063', 'treasury_code' => 'DAA', 'status' => 1],
];


        foreach ($districts as $district) {
            $exists = DB::table('bs_district_master')
                ->where('state_id', $district['state_id'])
                ->where('name', $district['name'])
                ->where('district_type', $district['district_type'])
                ->exists();

            if (!$exists) {
                DB::table('bs_district_master')->insert([
                    'state_id'       => $district['state_id'],
                    'id'    => $district['previous_id'],
                    'schcd'          => $district['schcd'],
                    'name'           => $district['name'],
                    'district_type'  => $district['district_type'],
                    'ddo_code'       => $district['ddo_code'],
                    'treasury_code'  => $district['treasury_code'],
                    'status'         => $district['status'],
                    'created_at'     => Carbon::now(),
                    'updated_at'     => Carbon::now(),
                ]);
            }
        }   
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class BsStateMasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('bs_state_master')->insert([
            ['id' => 18, 'schcd' => '18', 'name' => 'ASSAM', 'status' => '1'],
            ['id' => 11, 'schcd' => '11', 'name' => 'SIKKIM', 'status' => '1'],
            ['id' => 14, 'schcd' => '14', 'name' => 'MANIPUR', 'status' => '1'],
            ['id' => 10, 'schcd' => '10', 'name' => 'BIHAR', 'status' => '1'],
            ['id' => 7,  'schcd' => '07', 'name' => 'DELHI', 'status' => '1'],
            ['id' => 8,  'schcd' => '08', 'name' => 'RAJASTHAN', 'status' => '1'],
            ['id' => 29, 'schcd' => '30', 'name' => 'GOA', 'status' => '1'],
            ['id' => 21, 'schcd' => '22', 'name' => 'CHHATTISGA', 'status' => '1'],
            ['id' => 17, 'schcd' => '17', 'name' => 'MEGHALAYA', 'status' => '1'],
            ['id' => 32, 'schcd' => '33', 'name' => 'TAMIL NADU', 'status' => '1'],
            ['id' => 23, 'schcd' => '24', 'name' => 'GUJARAT', 'status' => '1'],
            ['id' => 4,  'schcd' => '04', 'name' => 'CHANDIGARH', 'status' => '1'],
            ['id' => 6,  'schcd' => '06', 'name' => 'HARYANA', 'status' => '1'],
            ['id' => 13, 'schcd' => '13', 'name' => 'NAGALAND', 'status' => '1'],
            ['id' => 31, 'schcd' => '32', 'name' => 'KERALA', 'status' => '1'],
            ['id' => 3,  'schcd' => '03', 'name' => 'PUNJAB', 'status' => '1'],
            ['id' => 15, 'schcd' => '15', 'name' => 'MIZORAM', 'status' => '1'],
            ['id' => 28, 'schcd' => '29', 'name' => 'KARNATAKA', 'status' => '1'],
            ['id' => 16, 'schcd' => '16', 'name' => 'TRIPURA', 'status' => '1'],
            ['id' => 20, 'schcd' => '21', 'name' => 'ORISSA', 'status' => '1'],
            ['id' => 19, 'schcd' => '20', 'name' => 'JHARKHAND', 'status' => '1'],
            ['id' => 1,  'schcd' => '19', 'name' => 'WEST BENGAL', 'status' => '1'],
            ['id' => 99, 'schcd' => '99', 'name' => 'OTHER', 'status' => '1'],
            ['id' => 2,  'schcd' => '02', 'name' => 'HIMACHAL PRADESH', 'status' => '1'],
            ['id' => 9,  'schcd' => '09', 'name' => 'UTTAR PRADESH', 'status' => '1'],
            ['id' => 12, 'schcd' => '12', 'name' => 'ARUNACHAL PRADESH', 'status' => '1'],
            ['id' => 22, 'schcd' => '23', 'name' => 'MADHYA PRADESH', 'status' => '1'],
            ['id' => 24, 'schcd' => '25', 'name' => 'DAMAN AND DIU', 'status' => '1'],
            ['id' => 25, 'schcd' => '26', 'name' => 'DADRA AND NAGAR HAVELI', 'status' => '1'],
            ['id' => 27, 'schcd' => '28', 'name' => 'ANDHRA PRADESH', 'status' => '1'],
            ['id' => 30, 'schcd' => '31', 'name' => 'LAKSHADWEEP', 'status' => '1'],
            ['id' => 33, 'schcd' => '34', 'name' => 'PONDICHERRY', 'status' => '1'],
            ['id' => 34, 'schcd' => '35', 'name' => 'ANDAMAN AND NICOBAR', 'status' => '1'],
            ['id' => 35, 'schcd' => '01', 'name' => 'JAMMU AND KASHMIR', 'status' => '1'],
            ['id' => 26, 'schcd' => '27', 'name' => 'MAHARASHTRA', 'status' => '1'],
            ['id' => 5,  'schcd' => '05', 'name' => 'UTTARAKHAND', 'status' => '1'],
        ]);
    }
}

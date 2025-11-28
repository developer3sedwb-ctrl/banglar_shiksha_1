<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class BsSubdivsionMasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
public function run(): void
    {
        $now = Carbon::now();
        // Map old district previous_id → new district id
        // Raw data: previous_id, schcd, name, edu_district_code_fk, delete_status
        $data = [
            [ 'id' => 4, 'district_id' => 15, 'schcd' => '19021', 'name' => 'ALIPURDUAR', 'status' => 1, 'created_at' => $now, 'updated_at' => $now ],
            [ 'id' => 16, 'district_id' => 9, 'schcd' => '19061', 'name' => 'CHANCHAL', 'status' => 1, 'created_at' => $now, 'updated_at' => $now ],
            [ 'id' => 53, 'district_id' => 11, 'schcd' => '19171', 'name' => 'KOLKATA', 'status' => 1, 'created_at' => $now, 'updated_at' => $now ],
            [ 'id' => 37, 'district_id' => 99, 'schcd' => '19112', 'name' => 'BARRACKPORE', 'status' => 1, 'created_at' => $now, 'updated_at' => $now ],
            [ 'id' => 60, 'district_id' => 14, 'schcd' => '19192', 'name' => 'EGRA', 'status' => 1, 'created_at' => $now, 'updated_at' => $now ],
            [ 'id' => 20, 'district_id' => 5, 'schcd' => '19073', 'name' => 'KANDI', 'status' => 1, 'created_at' => $now, 'updated_at' => $now ],
            [ 'id' => 45, 'district_id' => 4, 'schcd' => '19131', 'name' => 'BANKURA SADAR', 'status' => 1, 'created_at' => $now, 'updated_at' => $now ],
            [ 'id' => 46, 'district_id' => 4, 'schcd' => '19132', 'name' => 'BISHNUPUR', 'status' => 1, 'created_at' => $now, 'updated_at' => $now ],
            [ 'id' => 47, 'district_id' => 4, 'schcd' => '19133', 'name' => 'KHATRA', 'status' => 1, 'created_at' => $now, 'updated_at' => $now ],
            [ 'id' => 23, 'district_id' => 19, 'schcd' => '19081', 'name' => 'BOLPUR', 'status' => 1, 'created_at' => $now, 'updated_at' => $now ],
            [ 'id' => 24, 'district_id' => 19, 'schcd' => '19082', 'name' => 'RAMPURHAT', 'status' => 1, 'created_at' => $now, 'updated_at' => $now ],
            [ 'id' => 25, 'district_id' => 19, 'schcd' => '19083', 'name' => 'SURI SADAR', 'status' => 1, 'created_at' => $now, 'updated_at' => $now ],
            [ 'id' => 21, 'district_id' => 5, 'schcd' => '19074', 'name' => 'LALBAG', 'status' => 1, 'created_at' => $now, 'updated_at' => $now ],
            [ 'id' => 7, 'district_id' => 6, 'schcd' => '19031', 'name' => 'DINHATA', 'status' => 1, 'created_at' => $now, 'updated_at' => $now ],
            [ 'id' => 8, 'district_id' => 6, 'schcd' => '19032', 'name' => 'COOCH BEHAR SADAR', 'status' => 1, 'created_at' => $now, 'updated_at' => $now ],
            [ 'id' => 9, 'district_id' => 6, 'schcd' => '19033', 'name' => 'MATHABHANGA', 'status' => 1, 'created_at' => $now, 'updated_at' => $now ],
            [ 'id' => 10, 'district_id' => 6, 'schcd' => '19034', 'name' => 'MEKLIGANJ', 'status' => 1, 'created_at' => $now, 'updated_at' => $now ],
            [ 'id' => 11, 'district_id' => 6, 'schcd' => '19035', 'name' => 'TUFANGANJ', 'status' => 1, 'created_at' => $now, 'updated_at' => $now ],
            [ 'id' => 32, 'district_id' => 17, 'schcd' => '19101', 'name' => 'KALYANI', 'status' => 1, 'created_at' => $now, 'updated_at' => $now ],
            [ 'id' => 15, 'district_id' => 7, 'schcd' => '19052', 'name' => 'GANGARAMPUR', 'status' => 1, 'created_at' => $now, 'updated_at' => $now ],
            [ 'id' => 14, 'district_id' => 7, 'schcd' => '19051', 'name' => 'BALURGHAT', 'status' => 1, 'created_at' => $now, 'updated_at' => $now ],
            [ 'id' => 3, 'district_id' => 21, 'schcd' => '19013', 'name' => 'KURSEONG', 'status' => 1, 'created_at' => $now, 'updated_at' => $now ],
            [ 'id' => 1, 'district_id' => 21, 'schcd' => '19011', 'name' => 'DARJEELING SADAR', 'status' => 1, 'created_at' => $now, 'updated_at' => $now ],
            [ 'id' => 35, 'district_id' => 17, 'schcd' => '19104', 'name' => 'KRISNANAGAR SADAR', 'status' => 1, 'created_at' => $now, 'updated_at' => $now ],
            [ 'id' => 41, 'district_id' => 1, 'schcd' => '19121', 'name' => 'ARAMBAGH', 'status' => 1, 'created_at' => $now, 'updated_at' => $now ],
            [ 'id' => 33, 'district_id' => 17, 'schcd' => '19102', 'name' => 'RANAGHAT', 'status' => 1, 'created_at' => $now, 'updated_at' => $now ],
            [ 'id' => 42, 'district_id' => 1, 'schcd' => '19122', 'name' => 'CHANDANNAGORE', 'status' => 1, 'created_at' => $now, 'updated_at' => $now ],
            [ 'id' => 44, 'district_id' => 1, 'schcd' => '19124', 'name' => 'SRIRAMPORE', 'status' => 1, 'created_at' => $now, 'updated_at' => $now ],
            [ 'id' => 43, 'district_id' => 1, 'schcd' => '19123', 'name' => 'CHINSURA', 'status' => 1, 'created_at' => $now, 'updated_at' => $now ],
            [ 'id' => 51, 'district_id' => 20, 'schcd' => '19161', 'name' => 'HOWRAH SADAR', 'status' => 1, 'created_at' => $now, 'updated_at' => $now ],
            [ 'id' => 52, 'district_id' => 20, 'schcd' => '19162', 'name' => 'ULUBERIA', 'status' => 1, 'created_at' => $now, 'updated_at' => $now ],
            [ 'id' => 34, 'district_id' => 17, 'schcd' => '19103', 'name' => 'TEHATTA', 'status' => 1, 'created_at' => $now, 'updated_at' => $now ],
            [ 'id' => 6, 'district_id' => 2, 'schcd' => '19023', 'name' => 'MALBAZAR', 'status' => 1, 'created_at' => $now, 'updated_at' => $now ],
            [ 'id' => 5, 'district_id' => 2, 'schcd' => '19022', 'name' => 'JALPAIGURI SADAR', 'status' => 1, 'created_at' => $now, 'updated_at' => $now ],
            [ 'id' => 63, 'district_id' => 8, 'schcd' => '19201', 'name' => 'JHARGRAM', 'status' => 1, 'created_at' => $now, 'updated_at' => $now ],
            [ 'id' => 2, 'district_id' => 24, 'schcd' => '19012', 'name' => 'KALIMPONG', 'status' => 1, 'created_at' => $now, 'updated_at' => $now ],
            [ 'id' => 17, 'district_id' => 9, 'schcd' => '19062', 'name' => 'MALDA SADAR', 'status' => 1, 'created_at' => $now, 'updated_at' => $now ],
            [ 'id' => 39, 'district_id' => 99, 'schcd' => '19114', 'name' => 'BIDHANNAGAR', 'status' => 1, 'created_at' => $now, 'updated_at' => $now ],
            [ 'id' => 22, 'district_id' => 5, 'schcd' => '19075', 'name' => 'BARHAMPUR', 'status' => 1, 'created_at' => $now, 'updated_at' => $now ],
            [ 'id' => 18, 'district_id' => 5, 'schcd' => '19071', 'name' => 'DOMKOL', 'status' => 1, 'created_at' => $now, 'updated_at' => $now ],
            [ 'id' => 19, 'district_id' => 5, 'schcd' => '19072', 'name' => 'JANGIPUR', 'status' => 1, 'created_at' => $now, 'updated_at' => $now ],
            [ 'id' => 58, 'district_id' => 18, 'schcd' => '19185', 'name' => 'BARUIPUR', 'status' => 1, 'created_at' => $now, 'updated_at' => $now ],
            [ 'id' => 40, 'district_id' => 23, 'schcd' => '19115', 'name' => 'BANGAON', 'status' => 1, 'created_at' => $now, 'updated_at' => $now ],
            [ 'id' => 56, 'district_id' => 18, 'schcd' => '19183', 'name' => 'CANNING', 'status' => 1, 'created_at' => $now, 'updated_at' => $now ],
            [ 'id' => 36, 'district_id' => 23, 'schcd' => '19111', 'name' => 'BARASAT SADAR', 'status' => 1, 'created_at' => $now, 'updated_at' => $now ],
            [ 'id' => 38, 'district_id' => 23, 'schcd' => '19113', 'name' => 'BASIRHAT', 'status' => 1, 'created_at' => $now, 'updated_at' => $now ],
            [ 'id' => 55, 'district_id' => 18, 'schcd' => '19182', 'name' => 'DIAMOND HARBOUR', 'status' => 1, 'created_at' => $now, 'updated_at' => $now ],
            [ 'id' => 26, 'district_id' => 25, 'schcd' => '19091', 'name' => 'ASANSOLE SADAR', 'status' => 1, 'created_at' => $now, 'updated_at' => $now ],
            [ 'id' => 27, 'district_id' => 25, 'schcd' => '19092', 'name' => 'DURGAPUR', 'status' => 1, 'created_at' => $now, 'updated_at' => $now ],
            [ 'id' => 64, 'district_id' => 22, 'schcd' => '19202', 'name' => 'KHARAGPUR', 'status' => 1, 'created_at' => $now, 'updated_at' => $now ],
            [ 'id' => 66, 'district_id' => 22, 'schcd' => '19204', 'name' => 'MEDINIPUR SADAR', 'status' => 1, 'created_at' => $now, 'updated_at' => $now ],
            [ 'id' => 65, 'district_id' => 22, 'schcd' => '19203', 'name' => 'GHATAL', 'status' => 1, 'created_at' => $now, 'updated_at' => $now ],
            [ 'id' => 28, 'district_id' => 3, 'schcd' => '19093', 'name' => 'KALNA', 'status' => 1, 'created_at' => $now, 'updated_at' => $now ],
            [ 'id' => 29, 'district_id' => 3, 'schcd' => '19094', 'name' => 'KATWA', 'status' => 1, 'created_at' => $now, 'updated_at' => $now ],
            [ 'id' => 59, 'district_id' => 14, 'schcd' => '19191', 'name' => 'CONTAI', 'status' => 1, 'created_at' => $now, 'updated_at' => $now ],
            [ 'id' => 61, 'district_id' => 14, 'schcd' => '19193', 'name' => 'HALDIA', 'status' => 1, 'created_at' => $now, 'updated_at' => $now ],
            [ 'id' => 62, 'district_id' => 14, 'schcd' => '19194', 'name' => 'TAMLUK SADAR', 'status' => 1, 'created_at' => $now, 'updated_at' => $now ],
            [ 'id' => 57, 'district_id' => 18, 'schcd' => '19184', 'name' => 'KAKDWIP', 'status' => 1, 'created_at' => $now, 'updated_at' => $now ],
            [ 'id' => 12, 'district_id' => 10, 'schcd' => '19041', 'name' => 'ISLAMPUR', 'status' => 1, 'created_at' => $now, 'updated_at' => $now ],
            [ 'id' => 13, 'district_id' => 10, 'schcd' => '19042', 'name' => 'RAIGANJ', 'status' => 1, 'created_at' => $now, 'updated_at' => $now ],
            [ 'id' => 48, 'district_id' => 13, 'schcd' => '19141', 'name' => 'RAGHUNATHPUR', 'status' => 1, 'created_at' => $now, 'updated_at' => $now ],
            [ 'id' => 49, 'district_id' => 13, 'schcd' => '19142', 'name' => 'PURULIA SADAR', 'status' => 1, 'created_at' => $now, 'updated_at' => $now ],
            [ 'id' => 54, 'district_id' => 18, 'schcd' => '19181', 'name' => 'ALIPORE SADAR', 'status' => 1, 'created_at' => $now, 'updated_at' => $now ],
            [ 'id' => 30, 'district_id' => 3, 'schcd' => '19095', 'name' => 'BARDHAMAN SADAR NORTH', 'status' => 1, 'created_at' => $now, 'updated_at' => $now ],
            [ 'id' => 31, 'district_id' => 3, 'schcd' => '19096', 'name' => 'BARDHAMAN SADAR SOUTH (MEMARI)', 'status' => 1, 'created_at' => $now, 'updated_at' => $now ],
            [ 'id' => 50, 'district_id' => 13, 'schcd' => '19143', 'name' => 'JHALDA', 'status' => 1, 'created_at' => $now, 'updated_at' => $now ],
            [ 'id' => 68, 'district_id' => 13, 'schcd' => 'None', 'name' => 'MANBAZAR', 'status' => 1, 'created_at' => $now, 'updated_at' => $now ],
            [ 'id' => 69, 'district_id' => 21, 'schcd' => 'None', 'name' => 'MIRIK', 'status' => 1, 'created_at' => $now, 'updated_at' => $now ],
            [ 'id' => 67, 'district_id' => 12, 'schcd' => '19211', 'name' => 'SILIGURI', 'status' => 1, 'created_at' => $now, 'updated_at' => $now ],
        ];

        DB::table('bs_subdivision_master')->insert($data);
    }
}

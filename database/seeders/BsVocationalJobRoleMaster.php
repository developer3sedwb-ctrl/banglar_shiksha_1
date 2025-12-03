<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class BsVocationalJobRoleMaster extends Seeder
{
    /**
     * Run the database seeds.
     */
public function run(): void
    {
        $now = now();

        // FORMAT:
        // id, sector_code_fk, name, delete_status (O or N)

        $rows = [
            [1,  null, 'DAIRY WORKER', 'O'],
            [2,  null, 'FLORICULTURIST (OPEN CULTIVATION)', 'O'],
            [4,  null, 'VEGETABLE PRODUCTIO', 'O'],
            [5,  null, 'PADDY FARMER', 'O'],
            [6,  null, 'NURSERY WORKER', 'O'],
            [7,  null, 'APPAREL PRODUCTION ASSISTANT', 'O'],
            [8,  null, 'ASSISTANT FASHION DESIGNER (APPAREL)', 'O'],
            [9,  null, 'HAND EMBROIDERER', 'O'],
            [12, null, 'BUSINESS CORRESPONDENT', 'O'],
            [17, null, 'REPAIR AND MAINTENANCE OF COMPUTER AND PERIPHERAL', 'O'],
            [19, null, 'VISION TECHNICIA', 'O'],
            [20, null, 'DOMESTIC BIOMETRIC DATA OPERATOR', 'O'],
            [21, null, 'DOMESTIC IT HELP DESK ATTENDANT', 'O'],
            [22, null, 'SERVICE DESK ATTENDANT', 'O'],
            [24, null, 'WAREHOUSE ASSISTANT', 'O'],
            [25, null, 'ANIMATOR', 'O'],
            [26, null, 'STORY BOARD ARTIST', 'O'],
            [27, null, 'MAHARASHTRA ONLY', 'O'],
            [28, null, 'PHYSICAL TRAINER/TEACHER', 'O'],
            [29, null, 'CASHIER', 'O'],
            [32, null, 'TRAINEE ASSOCIATE', 'O'],
            [34, null, 'IN-STORE PROMOTER', 'O'],
            [36, null, 'HOUSEKEEPING ATTENDANT', 'O'],
            [38, null, 'TRANSFER ASSISTANT', 'O'],
            [39, null, 'TRAVEL AGENCY ASSISTANT', 'O'],
            [40, 78,  'MEET & GREET OFFICER', 'N'],
            [37, 78,  'TOUR ASSISTANT', 'N'],
            [18, 68,  'GENERAL DUTY ASSISTANT/PATIENT CARE ASSISTANT', 'N'],
            [13, 66,  'MASON', 'N'],
            [10, 63,  'AUTOMOTIVE SERVICE TECHNICIAN L3', 'N'],
            [11, 64,  'ASSISTANT BEAUTY THERAPIST', 'N'],
            [14, null, 'DOMESTIC APPLIANCES TECHNICIAN', 'O'],
            [15, null, 'HOME ELECTRIC TECHNICIAN', 'O'],
            [16, null, 'TV REPAIR TECHNICIAN', 'O'],
            [23, 69,  'DOMESTIC DATA ENTRY OPERATOR', 'N'],
            [30, 74,  'SALES ASSOCIATE', 'N'],
            [31, 74,  'STORE OPERATION ASSISTANT', 'N'],
            [33, 75,  'UNARMED SECURITY GUARD', 'N'],
            [35, null, 'CUSTOMER CARE EXECUTIVE (CALL CENTRE)', 'O'],
            [41, 61,  'SOLANACEOUS CROP CULTIVATOR', 'N'],
            [42, 62,  'SEWING MACHINE OPERATOR', 'N'],
            [43, 62,  'SPECIALISED SEWING MACHINE OPERATOR', 'N'],
            [44, 63,  'FOUR WHEELER SERVICE ASSISTANT', 'N'],
            [45, 63,  'FOUR WHEELER SERVICE TECHNICIAN', 'N'],
            [46, 63,  'AUTOMOTIVE SERVICE TECHNICIAN L4', 'N'],
            [47, 64,  'BEAUTY THERAPIST', 'N'],
            [48, 66,  'ASSISTANT MASON', 'N'],
            [49, 66,  'BRICK MASON (ELECTIVES: GENERAL/PLASTERING)', 'N'],
            [50, 67,  'FIELD TECHNICIAN OTHER HOME APPLIANCES', 'N'],
            [51, 67,  'FIELD TECHNICIAN COMPUTING AND PERIPHERALS', 'N'],
            [52, 68,  'HOME HEALTH AIDE TRAINEE', 'N'],
            [53, 68,  'HOME HEALTH AIDE INDUCTEE/TRAINEE', 'N'],
            [54, 68,  'GENERAL DUTY ASSISTANT- INDUCTEE/ TRAINEE', 'N'],
            [55, 69,  'CRM DOMESTIC VOICE', 'N'],
            [56, 80,  'ASSISTANT PLUMBER GENERAL', 'N'],
            [57, 80,  'PLUMBER (GERNERAL)', 'N'],
            [58, 80,  'PLUMBER (GERNERAL) II', 'N'],
            [59, 82,  'CONSUMER ENERGY METER TECHNICIAN', 'N'],
            [60, 82,  'DISTRIBUTION LINEMAN', 'N'],
            [61, 74,  'RETAIL STORE OPERATIONS ASSISTANT', 'N'],
            [62, 74,  'RETAIL SALES ASSOCIATE', 'N'],
            [63, 78,  'FOOD & BEVERAGE SERVICE ASSISTANT', 'N'],
            [64, 78,  'FOOD & BEVERAGE SERVICE TRAINEE', 'N'],
        ];

        $data = [];

        foreach ($rows as $row) {
            $data[] = [
                'id'             => $row[0],
                'sector_code_fk' => $row[1],
                'name'           => $row[2],
                'status'         => $row[3] === 'N' ? 1 : 2, // N = 1, O = 2
                'created_at'     => $now,
                'updated_at'     => $now,
            ];
        }

        DB::table('bs_vocational_job_role_master')->insert($data);

        DB::statement("
            SELECT setval(
                pg_get_serial_sequence('bs_vocational_job_role_master','id'),
                (SELECT MAX(id) FROM bs_vocational_job_role_master)
            );
        ");
    }
}

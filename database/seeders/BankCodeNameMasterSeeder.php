<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BankCodeNameMasterSeeder extends Seeder
{
    public function run(): void
    {
        $now = now();

        $rows = [
            ['BANK OF INDIA', 'BKID', 'BKID0', '15', 'N'],
            ['WEST BENGAL STATE COOPERATIVE BANK', 'WBSC', 'WBSC0', '12', 'N'],
            ['UNION BANK OF INDIA', 'UBIN', 'UBIN0', '15', 'N'],
            ['PASCHIM BANGA GRAMIN BANK (A govt.Enterprise)', 'UCBA0', 'UCBA0RRBPBG', '14', 'N'],
            ['IDBI (11 Digit)', 'IBKL2', 'IBKL0', '11', 'O'],
            ['IDBI BANK(NEW)', 'IBKL1', 'IBKL0', '16', 'O'],
            ['PUNJAB NATIONAL BANK', 'PUNB', 'PUNB0', '13/14/16', 'N'],
            ['AU SMALL FINANCE BANK LIMITED', 'AUBL', 'AUBL0', '16', 'N'],
            ['FEDERAL BANK', 'FDRL', 'FDRL0', '14', 'N'],
            ['HSBC BANK', 'HSBC', 'HSBC0', '12', 'N'],
            ['ALLAHABAD BANK', 'ALLA', 'ALLA0', '11', 'O'],
            ['ANDHRA BANK', 'ANDB', 'ANDB0', '15', 'O'],
            ['AXIS BANK', 'UTIB', 'UTIB0', '15', 'N'],
            ['BANK OF MAHARASTHRA', 'MAHB', 'MAHB0', '11', 'N'],
            ['BURDWAN CENTRAL COOPERATIVE BANK', 'HDFC0', 'HDFC0CBCCBL', '16', 'N'],
            ['CENTRAL BANK OF INDIA', 'CBIN', 'CBIN0', '10', 'N'],
            ['CORPORATION BANK', 'CORP', 'CORP0', '15', 'O'],
            ['DENA BANK(NEW)', 'BKDN1', 'BKDN0', '12', 'O'],
            ['HDFC', 'HDFC', 'HDFC0', '14', 'N'],
            ['INDIAN BANK(NEW)', 'IDIB1', 'IDIB0', '10', 'O'],
            ['INDIAN OVERSEAS BANK', 'IOBA', 'IOBA0', '15', 'N'],
            ['ING VYSYA BANK LTD', 'VYSA', 'VYSA0', '12', 'N'],
            ['ORIENTAL BANK OF COMMERCE', 'ORBC', 'ORBC0', '14', 'O'],
            ['STATE BANK OF HYDERABAD', 'SBHY', 'SBHY0', '11', 'N'],
            ['STATE BANK OF INDIA', 'SBIN', 'SBIN0', '11', 'N'],
            ['SYNDICATE BANK', 'SYNB', 'SYNB0', '14', 'O'],
            ['UCO BANK', 'UCBA', 'UCBA0', '14', 'N'],
            ['UNITED BANK OF INDIA', 'UTBI', 'UTBI0', '13', 'O'],
            ['UTTAR BANGA KHETRIYA GRAMIN BANK', 'CBIN1', 'CBIN0R40012', '16', 'N'],
            ['B N P PARIBAS', 'BNPA', 'BNPA0', '11', 'N'],
            ['BANDHAN BANK LIMITED', 'BDBL', 'BDBL0', '14', 'N'],
            ['CITI BANK', 'CITI', 'CITI0', '10', 'N'],
            ['CITY UNION BANK LIMITED', 'CIUB', 'CIUB0', '15', 'N'],
            ['CSB BANK LIMITED', 'CSBK', 'CSBK0', '18', 'N'],
            ['DBS BANK INDIA LIMITED', 'DBSS', 'DBSS0', '10', 'N'],
            ['DCB BANK LIMITED', 'DCBL', 'DCBL0', '14', 'N'],
            ['DEUSTCHE BANK', 'DEUT', 'DEUT0', '10', 'N'],
            ['DHANALAKSHMI BANK', 'DLXB', 'DLXB0', '16', 'N'],
            ['ICICI BANK LIMITED', 'ICIC', 'ICIC0', '12', 'N'],
            ['IDFC First Bank Ltd', 'IDFB', 'IDFB0', '11', 'N'],
            ['INDUSIND BANK', 'INDB', 'INDB0', '12', 'N'],
            ['JAMMU AND KASHMIR BANK LIMITED', 'JAKA', 'JAKA0', '16', 'N'],
            ['KARNATAKA BANK LIMITED', 'KARB', 'KARB0', '16', 'N'],
            ['KARUR VYSYA BANK', 'KVBL', 'KVBL0', '16', 'N'],
            ['LAXMI VILAS BANK', 'LAVB', 'LAVB0', '16', 'N'],
            ['PUNJAB AND SIND BANK', 'PSIB', 'PSIB0', '14', 'N'],
            ['RBL Bank Limited', 'RATN', 'RATN0', '12', 'N'],
            ['SOUTH INDIAN BANK', 'SIBL', 'SIBL0', '16', 'N'],
            ['STANDARD CHARTERED BANK', 'SCBL', 'SCBL0', '11', 'N'],
            ['YES BANK', 'YESB', 'YESB0', '15', 'N'],
            ['INDIA POST PAYMENT BANK', 'IPOS', 'IPOS0', '12', 'N'],
            ['UJJIVAN SMALL FINANCE BANK', 'UJVN', 'UJVN0', '16', 'N'],
            ['IDBI BANK', 'IBKL', 'IBKL0', '11/16', 'N'],
            ['INDIAN BANK', 'IDIB', 'IDIB0', '9/10/11', 'N'],
            ['BANGIYA GRAMIN VIKASH BANK', 'PUNB0', 'PUNB0RRBBGB', '13', 'N'],
            ['CANARA BANK', 'CNRB', 'CNRB0', '12/13/14', 'N'],
            ['VIJAYA BANK', 'VIJB', 'VIJB0', '15', 'O'],
            ['DENA BANK', 'BKDN', 'BKDN0', '11/12', 'O'],
            ['BANK OF BORODA', 'BARB', 'BARB0', '11/12/14/15', 'N'],
            ['KOTAK MAHINDRA BANK LIMITED', 'KKBK', 'KKBK0', '10/14', 'N'],
            ['FINO PAYMENTS BANK', 'FINO', 'FINO0', '11', 'N'],
        ];

        $data = [];

        foreach ($rows as $row) {
            $data[] = [
                'name'                 => $row[0],
                'bank_code'            => $row[1],
                'bank_ifsc'            => $row[2],
                'digit_in_account_no'  => $row[3],
                'status'               => $row[4] === 'N' ? 1 : 2,
                'created_at'           => $now,
                'updated_at'           => $now,
            ];
        }

        DB::table('bs_bank_code_name_master')->insert($data);
    }
}

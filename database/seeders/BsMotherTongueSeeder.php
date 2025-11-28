<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BsMotherTongueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $now = Carbon::now();
        $data = [
            ['id' => 30, 'name' => 'SANTHALI', 'status' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 99, 'name' => 'OTHER LANGUAGES', 'status' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 18, 'name' => 'URDU', 'status' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 53, 'name' => 'ORIYA(LOWER)', 'status' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 11, 'name' => 'NEPALI', 'status' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 14, 'name' => 'SANSKRIT', 'status' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 10, 'name' => 'MARATHI', 'status' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 7,  'name' => 'KONKANI', 'status' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 44, 'name' => 'BHOTI', 'status' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 47, 'name' => 'KAKBARAK', 'status' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 48, 'name' => 'KONYAK', 'status' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 5,  'name' => 'KANNADA', 'status' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 8,  'name' => 'MALAYALAM', 'status' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 58, 'name' => 'SEMA', 'status' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 25, 'name' => 'MIZO', 'status' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 29, 'name' => 'FRENCH', 'status' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 60, 'name' => 'TIBETA', 'status' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 49, 'name' => 'LADDAKHI', 'status' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 61, 'name' => 'ZELIANG', 'status' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 21, 'name' => 'MISING', 'status' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 17, 'name' => 'TELUGU', 'status' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 55, 'name' => 'PORTUGUESE', 'status' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 23, 'name' => 'KHASI', 'status' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 4,  'name' => 'HINDI', 'status' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 6,  'name' => 'KASHMIRI', 'status' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 13, 'name' => 'PUNJABI', 'status' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 45, 'name' => 'BODHI', 'status' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 27, 'name' => 'LEPCHA', 'status' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 9,  'name' => 'MANIPURI', 'status' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 50, 'name' => 'LOTHA', 'status' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 42, 'name' => 'AO', 'status' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 51, 'name' => 'MAITHILI', 'status' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 3,  'name' => 'GUJARATI', 'status' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 40, 'name' => 'MAITHILI', 'status' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 52, 'name' => 'NICOBAREE', 'status' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 43, 'name' => 'ARABIC', 'status' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 46, 'name' => 'GERMA', 'status' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 15, 'name' => 'SINDHI', 'status' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 54, 'name' => 'PERSIA', 'status' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 22, 'name' => 'DOGRI', 'status' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 28, 'name' => 'LIMBOO', 'status' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 16, 'name' => 'TAMIL', 'status' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 24, 'name' => 'GARO', 'status' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 59, 'name' => 'SPANISH', 'status' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 41, 'name' => 'ANGAMI', 'status' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 12, 'name' => 'ORIYA', 'status' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 20, 'name' => 'BODO', 'status' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 56, 'name' => 'RAJASTHANI', 'status' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 26, 'name' => 'BHUTIA', 'status' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 19, 'name' => 'ENGLISH', 'status' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 57, 'name' => 'RUSSIA', 'status' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 2,  'name' => 'ASSAMESE', 'status' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 1,  'name' => 'BENGALI', 'status' => 1, 'created_at' => $now, 'updated_at' => $now],
        ];
        DB::table('bs_mother_tongue_master')->insert($data);
    }
}

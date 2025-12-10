<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BsPanchayatMasterSeeder extends Seeder
{
    public function run(): void
    {        
    $csvPath = 'C:/laragon/banglar_shiksha_1/database/seeders/ep_panchayat_master.csv';

        // Disable FK checks
        DB::statement('SET session_replication_role = replica');

        // Truncate table
        DB::table('bs_panchayat_master')->truncate();

        // COPY command
        DB::statement("
            COPY bs_panchayat_master (
                id,
                name,
                district_code_fk,
                block_munc_code_fk,
                schcd,
                distcd,
                blkcd
            )
            FROM '{$csvPath}'
            WITH (
                FORMAT csv,
                HEADER true,
                NULL '',
                QUOTE '\"'
            )
        ");
        DB::statement("
            UPDATE bs_panchayat_master
            SET
                status = 1,
                created_at = NOW(),
                updated_at = NOW()
            WHERE created_at IS NULL
        ");



        // Enable FK checks
        DB::statement('SET session_replication_role = DEFAULT');
    }
}

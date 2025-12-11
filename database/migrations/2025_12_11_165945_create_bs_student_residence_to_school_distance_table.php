<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        /*
        |--------------------------------------------------------------------------
        | 1. CREATE MAIN PARTITIONED TABLE (PostgreSQL)
        |--------------------------------------------------------------------------
        */
        DB::statement("
            CREATE TABLE bs_student_master_other_addon_data (
                id BIGINT GENERATED ALWAYS AS IDENTITY,
                student_code CHAR(14) NOT NULL,
                school_id_fk BIGINT NOT NULL,
                district_id_fk SMALLINT NOT NULL,

                rte_entitlement_claimed_amount INTEGER,
                disabality_certificate_y_n SMALLINT,
                stu_residance_sch_distance_code_fk SMALLINT,

                cur_class_appeared_exam SMALLINT,
                cur_class_marks_percent NUMERIC(10,2),
                attendention_cur_year SMALLINT,

                entry_ip VARCHAR(15),
                update_ip VARCHAR(15),
                status SMALLINT DEFAULT 1,
                created_by BIGINT,
                updated_by BIGINT,
                update_by_stake_cd BIGINT,
                created_at TIMESTAMP,
                updated_at TIMESTAMP,
                deleted_at TIMESTAMP,
                PRIMARY KEY(student_code, district_id_fk)
            ) PARTITION BY LIST (district_id_fk);
        ");

        /*
        |--------------------------------------------------------------------------
        | 2. ADD FOREIGN KEYS
        |--------------------------------------------------------------------------
        */
        DB::statement("
            ALTER TABLE bs_student_master_other_addon_data
            ADD CONSTRAINT fk_school_id
            FOREIGN KEY (school_id_fk)
            REFERENCES bs_school_master(id);
        ");

        DB::statement("
            ALTER TABLE bs_student_master_other_addon_data
            ADD CONSTRAINT fk_district_id
            FOREIGN KEY (district_id_fk)
            REFERENCES bs_district_master(id);
        ");

        DB::statement("
            ALTER TABLE bs_student_master_other_addon_data
            ADD CONSTRAINT fk_residence_distance
            FOREIGN KEY (stu_residance_sch_distance_code_fk)
            REFERENCES bs_student_residence_to_school_distance(id);
        ");

        /*
        |--------------------------------------------------------------------------
        | 3. AUTO-CREATE PARTITIONS FOR EACH DISTRICT
        |--------------------------------------------------------------------------
        */
        $districts = DB::table('bs_district_master')->pluck('id');

        foreach ($districts as $distId) {

            $partitionName = "bs_student_master_other_addon_data_{$distId}";

            DB::statement("
                CREATE TABLE IF NOT EXISTS {$partitionName}
                PARTITION OF bs_student_master_other_addon_data
                FOR VALUES IN ({$distId});
            ");
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        /*
        |--------------------------------------------------------------------------
        | DROP ALL PARTITIONS FIRST
        |--------------------------------------------------------------------------
        */
        try {
            $districts = DB::table('bs_district_master')->pluck('id');

            foreach ($districts as $distId) {

                $partitionName = "bs_student_master_other_addon_data_{$distId}";

                DB::statement("DROP TABLE IF EXISTS {$partitionName} CASCADE;");
            }
        } catch (\Exception $e) {
            // ignore errors if district_master not available
        }

        /*
        |--------------------------------------------------------------------------
        | DROP MAIN TABLE
        |--------------------------------------------------------------------------
        */
        DB::statement("DROP TABLE IF EXISTS bs_student_master_other_addon_data CASCADE;");
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        /* -----------------------------------------------------
         | 1) MAIN PARTITIONED TABLE
         ----------------------------------------------------- */
        DB::statement("
            CREATE TABLE IF NOT EXISTS bs_student_facilities_history (
                id BIGINT GENERATED ALWAYS AS IDENTITY,
                district_id_fk SMALLINT NOT NULL,   -- PARTITION KEY
                school_id_fk BIGINT NOT NULL,

                student_code CHAR(14) NOT NULL,
                academic_year SMALLINT,

                district_code_fk SMALLINT,
                subdivision_code_fk SMALLINT,
                block_munc_code_fk SMALLINT,
                circle_code_fk SMALLINT,
                gs_ward_code_fk INTEGER,

                facilities_provided_y_n SMALLINT,
                free_uniform_y_n SMALLINT,
                free_transport_facility_y_n SMALLINT,
                free_escort_y_n SMALLINT,
                free_hostel_y_n SMALLINT,
                free_mobile_tab_comp_y_n SMALLINT,
                free_cycle_y_n SMALLINT,

                central_scholarship_rcv_y_n SMALLINT,
                central_scholarship_code_fk SMALLINT,

                state_scholarship_rcv_y_n SMALLINT,
                state_scholarship_code_fk SMALLINT,

                other_scholarship_rcv_y_n SMALLINT,
                other_scholarship_amount INTEGER,

                facilities_provided_cwsn_y_n SMALLINT,
                screened_for_specific_learning_disability_y_n SMALLINT,
                type_of_specific_learning_disability SMALLINT,
                screened_for_autism_spectrum_disorder_y_n SMALLINT,
                screened_for_attention_deficit_hyperactive_disorder_y_n SMALLINT,

                extracurricular_activity_involved_y_n SMALLINT,
                gifted_talented_child_in_mathematics SMALLINT,
                gifted_talented_child_in_language SMALLINT,
                gifted_talented_child_in_science SMALLINT,
                gifted_talented_child_in_technical SMALLINT,
                gifted_talented_child_in_sports SMALLINT,
                gifted_talented_child_in_art SMALLINT,

                provided_mentors_y_n SMALLINT,
                participated_in_nurturance_camps_y_n SMALLINT,
                state_level_y_n SMALLINT,
                national_level_y_n SMALLINT,

                appeared_state_olympiads_national_level_competition_y_n SMALLINT,
                participate_in_ncc_nss_scouts_guides_y_n SMALLINT,
                free_education_as_per_rte_act_y_n SMALLINT,

                child_homeless SMALLINT,
                complete_set_of_free_books_y_n SMALLINT,
                free_shoe_y_n SMALLINT,
                disadvantaged_group_y_n SMALLINT,
                free_exercise_book_y_n SMALLINT,
                special_training_facility_y_n SMALLINT,

                central_scholarship_amount INTEGER,
                state_scholarship_amount INTEGER,

                received_cwsn_braille_book_y_n SMALLINT,
                received_cwsn_braille_kit_y_n SMALLINT,
                received_cwsn_low_vision_kit_y_n SMALLINT,
                received_cwsn_braces_y_n SMALLINT,
                received_cwsn_crutches_y_n SMALLINT,
                received_cwsn_wheel_chair_y_n SMALLINT,
                received_cwsn_tri_cycle_y_n SMALLINT,
                received_cwsn_caliper_y_n SMALLINT,
                received_cwsn_escort_y_n SMALLINT,
                received_cwsn_hearing_aid_y_n SMALLINT,
                received_cwsn_stipend_y_n SMALLINT,
                received_cwsn_other_y_n SMALLINT,

                received_scholarship_kanyashree_code_fk SMALLINT,
                kanyashree_scholarship_amount INTEGER,

                facilities_received_cwsn_code_fk SMALLINT,

                digital_device_inc_internet_yn SMALLINT,
                digital_device_inc_internet_fk SMALLINT,

                entry_ip VARCHAR(15),
                update_ip VARCHAR(15),
                status SMALLINT DEFAULT 1,

                created_by BIGINT,
                updated_by BIGINT,
                update_by_stake_cd BIGINT NULL,
                created_at TIMESTAMP,
                updated_at TIMESTAMP,
                deleted_at TIMESTAMP,

                PRIMARY KEY(student_code, district_id_fk)
            )
            PARTITION BY LIST (district_id_fk);
        ");

        /* -----------------------------------------------------
         | 2) GET ALL DISTRICT IDs
         ----------------------------------------------------- */
        $districts = DB::table('bs_district_master')->select('id')->get();

        if ($districts->isEmpty()) {
            throw new Exception('Cannot create partitions: bs_district_master has no records.');
        }

        /* -----------------------------------------------------
         | 3) CREATE PARTITIONS & ADD FKs
         ----------------------------------------------------- */
        foreach ($districts as $d) {

            $part = "bs_student_facilities_history_{$d->id}";

            DB::statement("
                CREATE TABLE IF NOT EXISTS $part
                PARTITION OF bs_student_facilities_history
                FOR VALUES IN ({$d->id});
            ");

            /* --------------------------------------------
             | COMPOSITE FK TO bs_student_master
             --------------------------------------------- */
            DB::statement("
                ALTER TABLE $part
                ADD CONSTRAINT {$part}_student_fk
                    FOREIGN KEY (district_id_fk, student_code)
                    REFERENCES bs_student_master (district_code_fk, student_code)
                    ON UPDATE CASCADE
                    ON DELETE RESTRICT;
            ");

            /* FKs to location Masters */

            DB::statement("
                ALTER TABLE $part
                ADD CONSTRAINT {$part}_district_fk
                    FOREIGN KEY (district_id_fk) REFERENCES bs_district_master(id);
            ");

            DB::statement("
                ALTER TABLE $part
                ADD CONSTRAINT {$part}_school_fk
                    FOREIGN KEY (school_id_fk) REFERENCES bs_school_master(id);
            ");

            DB::statement("
                ALTER TABLE $part
                ADD CONSTRAINT {$part}_subdiv_fk
                    FOREIGN KEY (subdivision_code_fk) REFERENCES bs_subdivision_master(id);
            ");

            DB::statement("
                ALTER TABLE $part
                ADD CONSTRAINT {$part}_block_fk
                    FOREIGN KEY (block_munc_code_fk) REFERENCES bs_block_munc_corp_master(id);
            ");

            DB::statement("
                ALTER TABLE $part
                ADD CONSTRAINT {$part}_circle_fk
                    FOREIGN KEY (circle_code_fk) REFERENCES bs_circle_master(id);
            ");

            DB::statement("
                ALTER TABLE $part
                ADD CONSTRAINT {$part}_gs_ward_fk
                    FOREIGN KEY (gs_ward_code_fk) REFERENCES bs_gs_ward_master(id);
            ");
        }
    }

    public function down(): void
    {
        DB::statement("DROP TABLE IF EXISTS bs_student_facilities_history CASCADE;");
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
return new class extends Migration
{
    public function up(): void
    {
        /* ----------------------------------------------------
         | 1) Create MAIN PARTITIONED TABLE
         ---------------------------------------------------- */
        DB::statement("
            CREATE TABLE IF NOT EXISTS bs_student_vocational_details_archive (
                id BIGINT GENERATED ALWAYS AS IDENTITY,
                -- partition key (must match parent bs_student_master's partition column)
                district_code_fk SMALLINT NOT NULL,
                school_id_fk BIGINT NOT NULL,
                -- student_code that will be used to reference parent (must match parent column name & type)
                student_code CHAR(14) NOT NULL,
                academic_year SMALLINT,

                exposure_vocational_activities_y_n SMALLINT,
                undertake_vocational_course_y_n SMALLINT,

                vocational_course_code_fk INTEGER,
                vocational_trade_sector_code_fk BIGINT,
                vocational_job_role_code_fk BIGINT,

                vocational_class_attended_theory INTEGER,
                vocational_class_attended_practical INTEGER,
                vocational_class_attended_industry_training INTEGER,
                vocational_class_attended_field_visit INTEGER,

                prev_class_exam_appeared_fk INTEGER,
                prev_class_marks_percent_voc NUMERIC(10,2),

                applied_for_placement_code_fk INTEGER,
                applied_for_apprenticeship_code_fk INTEGER,

                vocational_nsqf_level_code_fk BIGINT,
                vocational_placement_status_code_fk BIGINT,
                vocational_salary_offered BIGINT,

                -- location columns (optional nullable)
                subdivision_code_fk SMALLINT,
                block_munc_code_fk SMALLINT,
                circle_code_fk SMALLINT,
                gs_ward_code_fk INTEGER,

                status SMALLINT DEFAULT 1,
                entry_ip VARCHAR(15),
                update_ip VARCHAR(15),
                created_by BIGINT,
                updated_by BIGINT,
                update_by_stake_cd BIGINT NULL,
                created_at TIMESTAMP,
                updated_at TIMESTAMP,
                deleted_at TIMESTAMP,

                -- PRIMARY KEY must include partition key
                PRIMARY KEY (id, district_code_fk)
            )
            PARTITION BY LIST (district_code_fk);
        ");

        /* ----------------------------------------------------
         | 2) Read all District IDs from bs_district_master
         ---------------------------------------------------- */
        $districts = DB::table('bs_district_master')->select('id')->get();

        if ($districts->isEmpty()) {
            throw new Exception("Cannot create partitions: bs_district_master has no rows.");
        }

        /* ----------------------------------------------------
         | 3) Create Partition Table for Each District
         ---------------------------------------------------- */
        foreach ($districts as $d) {

            // safe partition name
            $partitionName = "bs_student_vocational_details_archive_{$d->id}";

            DB::statement("
                CREATE TABLE IF NOT EXISTS {$partitionName}
                PARTITION OF bs_student_vocational_details_archive
                FOR VALUES IN ({$d->id});
            ");

            /* ----------------------------------------------------
             | 4) Add constraints / indexes on the partition
             |    - composite FK to bs_student_master(district_code_fk, student_code)
             |    - FKs to district and school and other masters
             ---------------------------------------------------- */

            // composite foreign key referencing parent composite key
            DB::statement("
                ALTER TABLE {$partitionName}
                ADD CONSTRAINT {$partitionName}_fk_student_master
                FOREIGN KEY (district_code_fk, student_code)
                REFERENCES bs_student_master (district_code_fk, student_code)
                ON UPDATE CASCADE
                ON DELETE RESTRICT;
            ");

            // fk to district master (single-column)
            DB::statement("
                ALTER TABLE {$partitionName}
                ADD CONSTRAINT {$partitionName}_fk_district
                FOREIGN KEY (district_code_fk)
                REFERENCES bs_district_master (id)
                ON UPDATE CASCADE
                ON DELETE RESTRICT;
            ");

            // fk to school
            DB::statement("
                ALTER TABLE {$partitionName}
                ADD CONSTRAINT {$partitionName}_fk_school
                FOREIGN KEY (school_id_fk)
                REFERENCES bs_school_master (id)
                ON UPDATE CASCADE
                ON DELETE RESTRICT;
            ");

            // optional location FKs (nullable columns accepted)
            DB::statement("
                ALTER TABLE {$partitionName}
                ADD CONSTRAINT {$partitionName}_fk_subdivision
                FOREIGN KEY (subdivision_code_fk)
                REFERENCES bs_subdivision_master (id)
                ON UPDATE CASCADE
                ON DELETE SET NULL;
            ");

            DB::statement("
                ALTER TABLE {$partitionName}
                ADD CONSTRAINT {$partitionName}_fk_block
                FOREIGN KEY (block_munc_code_fk)
                REFERENCES bs_block_munc_corp_master (id)
                ON UPDATE CASCADE
                ON DELETE SET NULL;
            ");

            DB::statement("
                ALTER TABLE {$partitionName}
                ADD CONSTRAINT {$partitionName}_fk_circle
                FOREIGN KEY (circle_code_fk)
                REFERENCES bs_circle_master (id)
                ON UPDATE CASCADE
                ON DELETE SET NULL;
            ");

            DB::statement("
                ALTER TABLE {$partitionName}
                ADD CONSTRAINT {$partitionName}_fk_gs_ward
                FOREIGN KEY (gs_ward_code_fk)
                REFERENCES bs_gs_ward_master (id)
                ON UPDATE CASCADE
                ON DELETE SET NULL;
            ");

            // helpful index for lookups by (district,student)
            DB::statement("
                CREATE INDEX IF NOT EXISTS idx_{$partitionName}_district_student_archive
                ON {$partitionName} (district_code_fk, student_code);
            ");

            // index by school
            DB::statement("
                CREATE INDEX IF NOT EXISTS idx_{$partitionName}_school
                ON {$partitionName} (school_id_fk);
            ");
        }
    }

    public function down(): void
    {
        DB::statement("DROP TABLE IF EXISTS bs_student_vocational_details_archive CASCADE;");
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // ---------------------------------------------------
        // 1) CREATE MAIN PARTITIONED TABLE
        // ---------------------------------------------------
        DB::statement("
            CREATE TABLE bs_student_delete_archive (
                id BIGINT GENERATED ALWAYS AS IDENTITY,
                state_code_fk INT NULL,
                district_code_fk INT NOT NULL,
                subdivision_code_fk INT,
                block_munc_code_fk INT NULL,
                circle_code_fk INT NOT NULL,
                gs_ward_code_fk INT,
                academic_year SMALLINT NOT NULL,
                student_code CHAR(14) NOT NULL,
                studentname VARCHAR(500),
                studentname_as_per_aadhaar VARCHAR(500),
                school_code_fk BIGINT,
                gender_code_fk SMALLINT,
                dob date,
                fathername VARCHAR(500),
                mothername VARCHAR(500),
                guardian_name VARCHAR(500),
                aadhaar_number CHAR(12),
                mothertonge_code_fk SMALLINT,
                social_category_code_fk SMALLINT,
                religion_code_fk SMALLINT,
                bpl_y_n SMALLINT,
                bpl_no VARCHAR(50),
                bpl_aay_beneficiary_y_n SMALLINT,
                disadvantaged_group_y_n SMALLINT,
                opted_for_vocational_cource SMALLINT,
                cwsn_y_n SMALLINT,
                cwsn_disability_type_code_fk SMALLINT,
                disability_percentage INTEGER,
                nationality_code_fk SMALLINT,
                out_of_sch_child_y_n SMALLINT,
                child_mainstreamed SMALLINT,
                blood_group_code_fk SMALLINT,
                birth_registration_number VARCHAR(50),
                identification_mark VARCHAR(100),
                health_id VARCHAR(50),
                stu_guardian_relationship SMALLINT,
                guardian_family_income SMALLINT,
                stu_height_in_cms SMALLINT,
                stu_weight_in_kgs SMALLINT,
                guardian_qualification SMALLINT,
                stu_country_code_fk SMALLINT,
                stu_contact_address VARCHAR(300),
                stu_contact_district SMALLINT,
                stu_contact_other_district VARCHAR(50),
                stu_contact_panchayat VARCHAR(100),
                stu_police_station VARCHAR(100),
                stu_mobile_no CHAR(10),
                stu_state_code_fk SMALLINT,
                stu_contact_habitation VARCHAR(300),
                stu_contact_block SMALLINT,
                stu_contact_other_block VARCHAR(50),
                stu_post_office VARCHAR(300),
                stu_pin_code CHAR(6),
                stu_email VARCHAR(100),
                address_equal SMALLINT DEFAULT 0,
                guardian_country_code_fk SMALLINT,
                guardian_state_code_fk SMALLINT,
                guardian_contact_address VARCHAR(300),
                guardian_contact_habitation VARCHAR(300),
                guardian_contact_district SMALLINT,
                guardian_contact_other_district VARCHAR(50),
                guardian_contact_block SMALLINT,
                guardian_contact_other_block VARCHAR(50),
                guardian_contact_panchayat VARCHAR(100),
                guardian_post_office VARCHAR(300),
                guardian_police_station VARCHAR(100),
                guardian_pin_code CHAR(6),
                guardian_mobile_no CHAR(10),
                guardian_email VARCHAR(100),
                admission_no VARCHAR(100),
                admission_date DATE,
                status_pre_year CHAR(4),
                prev_class_appeared_exam SMALLINT,
                prev_class_exam_result SMALLINT,
                prev_class_marks_percent DECIMAL(10,2),
                attendention_pre_year SMALLINT,
                pre_roll_number INT,
                pre_class_code_fk SMALLINT,
                pre_section_code_fk SMALLINT,
                pre_stream_code_fk SMALLINT,
                cur_class_code_fk SMALLINT,
                cur_section_code_fk SMALLINT,
                cur_stream_code_fk SMALLINT,
                cur_roll_number SMALLINT,
                medium_code_fk SMALLINT,
                admission_type_code_fk SMALLINT,
                bank_ifsc VARCHAR(20),
                stu_bank_acc_no VARCHAR(50),
                assembly_code_fk INT,
                student_img_upload_y_n SMALLINT DEFAULT 0,
                excel_code_fk INT,
                status SMALLINT DEFAULT 1,
                entry_ip VARCHAR(15),
                update_ip VARCHAR(15),
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP NULL,
                created_by BIGINT,
                updated_by BIGINT,
                update_by_stake_cd BIGINT NULL,
                deleted_at TIMESTAMP NULL,
                PRIMARY KEY (student_code)
            )
        ");

        // ---------------------------------------------------
        // 2) GLOBAL UNIQUE AADHAAR (NULLABLE SAFE)
        // ---------------------------------------------------
        DB::statement("
            CREATE UNIQUE INDEX uniq_delete_student_aadhaar_global
            ON bs_student_delete_archive (district_code_fk,aadhaar_number)
            WHERE aadhaar_number IS NOT NULL;
        ");

        // ---------------------------------------------------
        // 3) UNIQUE COMPOSITE ON IDENTITY (MUST INCLUDE PARTITION KEY)
        // ---------------------------------------------------
        DB::statement("
            ALTER TABLE bs_student_delete_archive
            ADD CONSTRAINT uniq_delete_student_identity
            UNIQUE (
                district_code_fk,
                studentname,
                fathername,
                mothername,
                dob
            );
        ");

        // ---------------------------------------------------
        // 5) FOREIGN KEYS (AFTER TABLE EXISTS)
        // ---------------------------------------------------
        Schema::table('bs_student_delete_archive', function (Blueprint $table) {
            $table->foreign('district_code_fk')->references('id')->on('bs_district_master');
            // $table->foreign('subdivision_code_fk')->references('id')->on('bs_subdivision_master');
            // $table->foreign('block_munc_code_fk')->references('id')->on('bs_block_munc_corp_master');
            $table->foreign('circle_code_fk')->references('id')->on('bs_circle_master');
            // $table->foreign('gs_ward_code_fk')->references('id')->on('bs_gs_ward_master');

            $table->foreign('school_code_fk')->references('id')->on('bs_school_master');
            $table->foreign('gender_code_fk')->references('id')->on('bs_gender_master');
            $table->foreign('mothertonge_code_fk')->references('id')->on('bs_mother_tongue_master');
            $table->foreign('social_category_code_fk')->references('id')->on('bs_social_category_master');
            $table->foreign('religion_code_fk')->references('id')->on('bs_religion_master');

            $table->foreign('nationality_code_fk')->references('id')->on('bs_nationality_master');
            $table->foreign('blood_group_code_fk')->references('id')->on('bs_blood_group_master');

            $table->foreign('stu_guardian_relationship')->references('id')->on('bs_guardian_relationship_master');
            $table->foreign('guardian_family_income')->references('id')->on('bs_income_master');
            $table->foreign('guardian_qualification')->references('id')->on('bs_guardian_qualification_master');

            $table->foreign('stu_country_code_fk')->references('id')->on('bs_country_master');
            $table->foreign('stu_state_code_fk')->references('id')->on('bs_state_master');
            $table->foreign('stu_contact_district')->references('id')->on('bs_district_master');
            // $table->foreign('stu_contact_block')->references('id')->on('bs_block_munc_corp_master');

            $table->foreign('guardian_country_code_fk')->references('id')->on('bs_country_master');
            $table->foreign('guardian_state_code_fk')->references('id')->on('bs_state_master');

            $table->foreign('guardian_contact_district')->references('id')->on('bs_district_master');
            // $table->foreign('guardian_contact_block')->references('id')->on('bs_block_munc_corp_master');
            // $table->foreign('status_pre_year')->references('id')->on('bs_previous_schooling_type_master');
            $table->foreign('pre_class_code_fk')->references('id')->on('bs_class_master');
            $table->foreign('pre_section_code_fk')->references('id')->on('bs_class_section_master');
            $table->foreign('pre_stream_code_fk')->references('id')->on('bs_stream_master');

            $table->foreign('cur_class_code_fk')->references('id')->on('bs_class_master');
            $table->foreign('cur_section_code_fk')->references('id')->on('bs_class_section_master');
            $table->foreign('cur_stream_code_fk')->references('id')->on('bs_stream_master');

            $table->foreign('medium_code_fk')->references('id')->on('bs_medium_master');
            $table->foreign('admission_type_code_fk')->references('id')->on('bs_admission_type_master');
            // $table->foreign('booth_code_fk')->references('id')->on('bs_booth_master');
            // $table->foreign('assembly_code_fk')->references('id')->on('bs_assembly_master');
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bs_student_delete_archive');
    }
};

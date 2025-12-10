<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bs_school_master', function (Blueprint $table) {

            // PRIMARY KEY
            $table->bigIncrements('id');
            $table->unsignedBigInteger('school_code_pk')->primary();

            // BASIC DETAILS
            $table->char('schcd', 11);
            $table->string('school_name', 100);
            $table->char('ac_year', 4);

            // LOCATION FOREIGN KEYS
            $table->unsignedSmallInteger('state_code_fk')->nullable();
            $table->unsignedSmallInteger('district_code_fk')->nullable();
            $table->unsignedSmallInteger('block_munc_corp_code_fk')->nullable();
            $table->unsignedSmallInteger('circle_code_fk')->nullable();
            $table->unsignedSmallInteger('cluster_code_fk')->nullable();
            $table->unsignedBigInteger('gs_ward_code_fk')->nullable();
            $table->unsignedBigInteger('panchayat_code_fk')->nullable();
            $table->unsignedInteger('assembly_constituency_code_fk')->nullable();
            $table->unsignedSmallInteger('parliamentary_constituency_code_fk')->nullable();
            $table->unsignedSmallInteger('city_code_fk')->nullable();
            $table->unsignedSmallInteger('rurb_code_fk')->nullable();

            // SCHOOL ATTRIBUTES
            $table->unsignedSmallInteger('school_category_code_fk')->nullable();
            $table->unsignedSmallInteger('school_management_code_fk')->nullable();
            $table->unsignedSmallInteger('school_type_code_fk')->nullable();
            $table->unsignedSmallInteger('low_class_code_fk')->nullable();
            $table->unsignedSmallInteger('high_class_code_fk')->nullable();

            // MEDIUMS & LANGUAGES
            $table->unsignedSmallInteger('medium_code_fk1')->nullable();
            $table->unsignedSmallInteger('medium_code_fk2')->nullable();
            $table->unsignedSmallInteger('medium_code_fk3')->nullable();
            $table->unsignedSmallInteger('medium_code_fk4')->nullable();
            $table->unsignedSmallInteger('language_code_fk1')->nullable();
            $table->unsignedSmallInteger('language_code_fk2')->nullable();
            $table->unsignedSmallInteger('language_code_fk3')->nullable();

            // GEO COORDINATES
            $table->decimal('latdeg', 10, 2)->default(0);
            $table->decimal('latmin', 10, 2)->default(0);
            $table->decimal('latsec', 10, 2)->default(0);
            $table->decimal('londeg', 10, 2)->default(0);
            $table->decimal('lonmin', 10, 2)->default(0);
            $table->decimal('lonsec', 10, 2)->default(0);

            // YEARS
            $table->unsignedSmallInteger('establishment_year')->nullable();
            $table->unsignedSmallInteger('recog_year_primary')->nullable();
            $table->unsignedSmallInteger('recog_year_secondary')->nullable();
            $table->unsignedSmallInteger('recog_year_hs')->nullable();
            $table->unsignedSmallInteger('recog_year_upri')->nullable();

            $table->unsignedSmallInteger('year_upgrd_pri_to_upri')->default(0);
            $table->unsignedSmallInteger('year_upgrd_upri_to_sec')->default(0);
            $table->unsignedSmallInteger('year_upgrd_sec_to_hsec')->default(0);

            // STATUS
            $table->char('delete_status', 1);
            $table->unsignedInteger('pin_code')->nullable();
            $table->unsignedSmallInteger('new_school_status')->nullable();
            $table->unsignedSmallInteger('school_status')->default(0);
            $table->unsignedSmallInteger('uniform_status')->default(0);

            // AUDIT FIELDS
            $table->string('entry_ip', 15)->nullable();
            $table->timestamp('entry_time')->nullable();
            $table->unsignedBigInteger('enter_by')->nullable();
            $table->unsignedSmallInteger('enter_by_stake_cd')->nullable();

            $table->string('update_ip', 15)->nullable();
            $table->timestamp('update_time')->nullable();
            $table->unsignedBigInteger('update_by')->nullable();
            $table->unsignedSmallInteger('update_by_stake_cd')->nullable();

            // EXTRA DETAILS
            $table->string('other_medium_name', 50)->nullable();
            $table->timestamp('active_date_from')->nullable();
            $table->timestamp('active_date_to')->nullable();
            $table->string('school_unique_code', 250)->nullable();
            $table->unsignedSmallInteger('subdiv_code_fk')->nullable();
            $table->unsignedInteger('village_code_fk')->nullable();
            $table->unsignedSmallInteger('edu_district_code_fk')->nullable();
            $table->char('gmba_status', 1)->nullable();
            $table->char('dise_code', 11)->nullable();

            $table->unsignedSmallInteger('sch_cat_type_code_fk')->nullable();
            $table->unsignedSmallInteger('secondary_affiliation_board_code_fk')->nullable();
            $table->unsignedSmallInteger('council_affiliation_board_code_fk')->nullable();
            $table->unsignedSmallInteger('secondary_exam_name_fk')->nullable();
            $table->unsignedSmallInteger('council_exam_name_fk')->nullable();

            $table->unsignedSmallInteger('subdivision_code_fk')->nullable();

            $table->unsignedInteger('hs_council_index_no_old')->nullable();
            $table->string('secondary_board_index_no', 15)->nullable();
            $table->string('hs_council_index_no', 15)->nullable();

            $table->unsignedSmallInteger('curriculum_followed_fk')->nullable();
            $table->string('other_curriculum_followed', 50)->nullable();

            $table->unsignedSmallInteger('noc_upload_status')->nullable();
            $table->smallInteger('status')->default(1);

            // Timestamps + soft delete
            $table->timestamps();
            $table->softDeletes();
        });

        // -----------------------------------------------------------
        // FOREIGN KEY DEFINITIONS (ALL POSSIBLE FK COLUMNS)
        // -----------------------------------------------------------
        Schema::table('bs_school_master', function (Blueprint $table) {

            // Administrative Hierarchy
            $table->foreign('state_code_fk')->references('id')->on('bs_state_master');
            $table->foreign('district_code_fk')->references('id')->on('bs_district_master');
            $table->foreign('block_munc_corp_code_fk')->references('id')->on('bs_block_munc_corp_master');
            $table->foreign('circle_code_fk')->references('id')->on('bs_circle_master');
            $table->foreign('cluster_code_fk')->references('id')->on('bs_cluster_master');
            $table->foreign('subdiv_code_fk')->references('id')->on('bs_subdivision_master');
            $table->foreign('edu_district_code_fk')->references('id')->on('bs_edu_district_master');

            // Geo-political mappings
            $table->foreign('gs_ward_code_fk')->references('id')->on('bs_gs_ward_master');
            $table->foreign('panchayat_code_fk')->references('id')->on('bs_panchayat_master');
            $table->foreign('assembly_constituency_code_fk')->references('id')->on('bs_assembly_master');
            $table->foreign('parliamentary_constituency_code_fk')->references('id')->on('bs_parliamentary_master');
            $table->foreign('city_code_fk')->references('id')->on('bs_city_master');
            $table->foreign('village_code_fk')->references('id')->on('bs_village_master');

            // School Structure
            $table->foreign('school_category_code_fk')->references('id')->on('bs_school_category_master');
            $table->foreign('school_management_code_fk')->references('id')->on('bs_school_management_master');
            $table->foreign('school_type_code_fk')->references('id')->on('bs_school_type_master');

            $table->foreign('low_class_code_fk')->references('id')->on('bs_class_master');
            $table->foreign('high_class_code_fk')->references('id')->on('bs_class_master');

            // Mediums & Languages
            $table->foreign('medium_code_fk1')->references('id')->on('bs_medium_master');
            $table->foreign('medium_code_fk2')->references('id')->on('bs_medium_master');
            $table->foreign('medium_code_fk3')->references('id')->on('bs_medium_master');
            $table->foreign('medium_code_fk4')->references('id')->on('bs_medium_master');

            $table->foreign('language_code_fk1')->references('id')->on('bs_language_master');
            $table->foreign('language_code_fk2')->references('id')->on('bs_language_master');
            $table->foreign('language_code_fk3')->references('id')->on('bs_language_master');

            // Affiliation Boards & Exam Names
            $table->foreign('sch_cat_type_code_fk')->references('id')->on('bs_school_category_type_master');
            $table->foreign('secondary_affiliation_board_code_fk')->references('id')->on('bs_board_master');
            $table->foreign('council_affiliation_board_code_fk')->references('id')->on('bs_board_master');
            $table->foreign('secondary_exam_name_fk')->references('id')->on('bs_exam_master');
            $table->foreign('council_exam_name_fk')->references('id')->on('bs_exam_master');

            // Curriculum
            $table->foreign('curriculum_followed_fk')->references('id')->on('bs_curriculum_master');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bs_school_master');
    }
};

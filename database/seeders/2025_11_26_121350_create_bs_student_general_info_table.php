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
        // 1. Create base table normally
        Schema::create('bs_student_general_info', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('student_id_fk');
            $table->foreign('student_id_fk')->references('id')->on('bs_student_master');

            $table->string('studentname',500);
            $table->string('studentname_as_per_aadhaar', 500)->nullable();

            // district column required for partitioning
            $table->smallInteger('district_id_fk'); // <-- REQUIRED

            // FK: school
            $table->unsignedBigInteger('school_id_fk');
            $table->foreign('school_id_fk')->references('id')->on('bs_school_master');

            // FK: gender
            $table->smallInteger('gender_code_fk');
            $table->foreign('gender_code_fk')->references('id')->on('bs_gender_master');

            $table->date('dob');

            $table->string('fathername',500);
            $table->string('mothername',500);
            $table->string('guardian_name',500);
            $table->char('aadhaar_number',12)->unique()->nullable();

            // FK: mother tongue
            $table->smallInteger('mothertonge_code_fk');
            $table->foreign('mothertonge_code_fk')->references('id')->on('bs_mother_tongue_master');

            // FK: social category
            $table->smallInteger('social_category_code_fk');
            $table->foreign('social_category_code_fk')->references('id')->on('bs_social_category_master');

            // FK: religion
            $table->smallInteger('religion_code_fk');
            $table->foreign('religion_code_fk')->references('id')->on('bs_religion_master');

            $table->smallInteger('bpl_y_n');
            $table->string('bpl_no',50)->nullable();
            $table->smallInteger('bpl_aay_beneficiary_y_n')->nullable();
            $table->smallInteger('disadvantaged_group_y_n');

            // CWSN
            $table->smallInteger('cwsn_y_n')->nullable();
            $table->smallInteger('cwsn_disability_type_code_fk')->nullable();
            $table->integer('disability_percentage')->nullable();

            // FK: nationality
            $table->smallInteger('nationality_code_fk');
            $table->foreign('nationality_code_fk')
                ->references('id')->on('bs_nationality_master');

            $table->smallInteger('out_of_sch_child_y_n');

            // FK: blood group
            $table->smallInteger('blood_group_code_fk')->nullable();
            $table->foreign('blood_group_code_fk')->references('id')
                ->on('bs_blood_group_master');

            $table->string('birth_registration_number',50)->nullable();
            $table->string('identification_mark',100)->nullable();
            $table->string('health_id',50)->nullable();

            // guardian relationship
            $table->smallInteger('stu_guardian_relationship');
            $table->foreign('stu_guardian_relationship')
                ->references('id')->on('bs_guardian_relationship_master');

            // guardian income
            $table->smallInteger('guardian_family_income');
            $table->foreign('guardian_family_income')
                ->references('id')->on('bs_income_master');

            $table->smallInteger('stu_height_in_cms');
            $table->smallInteger('stu_weight_in_kgs');

            // guardian qualification
            $table->smallInteger('guardian_qualification');
            $table->foreign('guardian_qualification')
                ->references('id')->on('bs_guardian_qualification_master');

            $table->timestamps();

            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by')->nullable();

            $table->softDeletes();

            $table->unique(['school_id_fk', 'deleted_at'], 'unique_school_student_general_info');
            $table->unique(['studentname', 'dob', 'fathername', 'mothername', 'deleted_at'], 'unique_student_identity');
            $table->index(['studentname', 'dob', 'fathername', 'mothername', 'deleted_at'], 'idx_student_identity');
        });

        // 2. Convert into PARTITIONED TABLE
        DB::statement("ALTER TABLE bs_student_general_info
                    PARTITION BY LIST (district_id_fk);");

        // 3. Automatically create partitions for each district
        $districts = DB::table('bs_district_master')->pluck('id');

        foreach ($districts as $districtId) {
            $partitionName = "bs_student_general_info_d{$districtId}";
            DB::statement("
                CREATE TABLE IF NOT EXISTS {$partitionName}
                PARTITION OF bs_student_general_info
                FOR VALUES IN ({$districtId});
            ");
        }
    }

    public function down(): void
    {
        // Drop all partitions first
        $districts = DB::table('bs_district_master')->pluck('id');
        foreach ($districts as $districtId) {
            $partitionName = "bs_student_general_info_d{$districtId}";
            DB::statement("DROP TABLE IF EXISTS {$partitionName} CASCADE;");
        }

        Schema::dropIfExists('bs_student_general_info');
    }

    /**
     * Reverse the migrations.
     */

};

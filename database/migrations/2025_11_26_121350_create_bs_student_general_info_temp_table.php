<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bs_student_general_info_temp', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('studentname',500);
            $table->string('studentname_as_per_aadhaar', 500)->nullable();
            // FK: school
            $table->unsignedBigInteger('school_id_fk');
            $table->foreign('school_id_fk')
                ->references('id')
                ->on('bs_school_master');
            // FK: gender
            $table->smallInteger('gender_code_fk');
            $table->foreign('gender_code_fk')
                ->references('id')
                ->on('bs_gender_master');

            // dob (NOT FK)
            $table->date('dob');

            $table->string('fathername',500);
            $table->string('mothername',500);
            $table->string('guardian_name',500);
            $table->char('aadhaar_number',12)->unique()->nullable();

            // FK: mother tongue
            $table->smallInteger('mothertonge_code_fk');
            $table->foreign('mothertonge_code_fk')
                ->references('id')
                ->on('bs_mother_tongue_master');

            // FK: social category
            $table->smallInteger('social_category_code_fk');
            $table->foreign('social_category_code_fk')
                ->references('id')
                ->on('bs_social_category_master');

            // FK: religion
            $table->smallInteger('religion_code_fk');
            $table->foreign('religion_code_fk')
                ->references('id')
                ->on('bs_religion_master');

            $table->smallInteger('bpl_y_n');
            $table->string('bpl_no',50)->nullable();
            $table->smallInteger('bpl_aay_beneficiary_y_n')->nullable();
            $table->smallInteger('disadvantaged_group_y_n');
            // CWSN details
            $table->smallInteger('cwsn_y_n')->nullable();
            $table->smallInteger('cwsn_disability_type_code_fk')->nullable();
            $table->integer('disability_percentage')->nullable();
            // FK: nationality
            $table->smallInteger('nationality_code_fk');
            $table->foreign('nationality_code_fk')
                ->references('id')
                ->on('bs_nationality_master');

            $table->smallInteger('out_of_sch_child_y_n');
            $table->smallInteger('child_mainstreamed')->nullable();
            // FK: blood group
            $table->smallInteger('blood_group_code_fk')->nullable();
            $table->foreign('blood_group_code_fk')
                ->references('id')
                ->on('bs_blood_group_master');

            $table->string('birth_registration_number',50)->nullable();
            $table->string('identification_mark',100)->nullable();
            $table->string('health_id',50)->nullable();

            // FK: guardian relationship
            $table->smallInteger('stu_guardian_relationship');
            $table->foreign('stu_guardian_relationship')
                ->references('id')
                ->on('bs_guardian_relationship_master');

            // FK: guardian income
            $table->smallInteger('guardian_family_income');
            $table->foreign('guardian_family_income')
                ->references('id')
                ->on('bs_income_master');

            $table->smallInteger('stu_height_in_cms');
            $table->smallInteger('stu_weight_in_kgs');

            // FK: guardian qualification
            $table->smallInteger('guardian_qualification');
            $table->foreign('guardian_qualification')
                ->references('id')
                ->on('bs_guardian_qualification_master');

            $table->smallInteger('status')->default(1);
            $table->string('entry_ip', 15)->nullable();
            $table->string('update_ip', 15)->nullable();
            $table->timestamps();
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('update_by_stake_cd')->nullable();
            $table->softDeletes();
            $table->unique(['school_id_fk', 'deleted_at'], 'unique_school_student_general_info');
            $table->unique(['studentname', 'dob', 'fathername', 'mothername', 'deleted_at'], 'unique_student_identity_temp');
            $table->index(['studentname', 'dob', 'fathername', 'mothername', 'deleted_at'], 'idx_student_identity_temp');
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bs_student_general_info_temp');
    }
};

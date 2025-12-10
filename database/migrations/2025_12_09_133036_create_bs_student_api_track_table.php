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
    // 1) CREATE PARTITIONED TABLE
    DB::statement("
        CREATE TABLE bs_student_api_track (
            id BIGINT GENERATED ALWAYS AS IDENTITY,
            student_code CHAR(14) NOT NULL,
            school_code_fk BIGINT NOT NULL,
            district_id_fk INT NOT NULL,
            sms_status SMALLINT,
            kanyashree_status SMALLINT,
            vocational_council_status SMALLINT,
            rbsk_status SMALLINT,
            bcw_status SMALLINT,
            udise_status SMALLINT,
            utsashree_status SMALLINT,
            sabooj_sathi_status SMALLINT,
            wbchse_status SMALLINT,
            status SMALLINT DEFAULT 1,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP NULL,
            deleted_at TIMESTAMP NULL,
            PRIMARY KEY (district_id_fk, student_code)
        )
        PARTITION BY LIST (district_id_fk);
    ");

    // 2) CREATE PARTITIONS FOR EVERY DISTRICT
    $districts = DB::table('bs_district_master')->pluck('id');

    foreach ($districts as $district) {
        DB::statement("
            CREATE TABLE bs_student_api_track_{$district}
            PARTITION OF bs_student_api_track
            FOR VALUES IN ({$district});
        ");
    }

    // 3) Add foreign keys
    Schema::table('bs_student_api_track', function (Blueprint $table) {
        $table->foreign('school_code_fk')
            ->references('id')->on('bs_school_master')
            ->onDelete('cascade');

        $table->foreign('district_id_fk')
            ->references('id')->on('bs_district_master')
            ->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bs_student_api_track');
    }
};

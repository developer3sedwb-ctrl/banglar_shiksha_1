<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration: Create bs_stu_disability_type_master table
 *
 * This table stores types of student disabilities
 * (e.g., Blindness, Low Vision, Locomotor Disability, etc.)
 * derived from ep_stu_disability_type_master.
 *
 * Columns:
 *  - id: Primary key
 *  - name: Disability type name
 *  - rank: Optional ranking
 *  - udise_active_status: UDISE active status (int2)
 *  - udise_code: UDISE code (int2)
 *  - status: 1 = active, 0 = inactive
 *  - deleted_at: Soft delete timestamp
 *  - created_at / updated_at: Audit timestamps
 *
 * Indexes:
 *  - Composite index on (status, rank)
 */
return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('bs_stu_disability_type_master')) {
            Schema::create('bs_stu_disability_type_master', function (Blueprint $table) {
                // Primary key
                $table->bigIncrements('id');

                // Core fields
                $table->string('name', 255)->comment('Disability type description');
                $table->smallInteger('rank')->nullable()->comment('Rank / ordering (int2)');
                $table->smallInteger('udise_active_status')->nullable()->comment('UDISE active status (int2)');
                $table->smallInteger('udise_code')->nullable()->comment('UDISE code (int2)');
                $table->smallInteger('status')->default(1)->comment('1 = active, 0 = inactive');

                // Audit fields
                $table->timestamps();      // created_at, updated_at
                $table->softDeletes();     // deleted_at (for soft delete support)

                // Indexes
                $table->index(['status', 'rank'], 'idx_bs_stu_disability_status_rank');
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('bs_stu_disability_type_master');
    }
};

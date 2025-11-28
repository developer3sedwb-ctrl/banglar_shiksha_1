<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration: Create the bs_special_training_facility_master table
 *
 * This table stores types of special training facilities
 * (e.g., Residential, Non-Residential, Not Applicable)
 * used in the Banglar Shiksha Portal. 
 *
 * Columns:
 *  - id: Primary key
 *  - name: Facility name (unique)
 *  - rank: Optional ranking for sorting
 *  - status: 1 = Active, 0 = Inactive
 *  - created_at / updated_at: Automatic timestamps
 *
 * Indexes:
 *  - Composite index on (status, rank) for optimized queries
 */
return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('bs_special_training_facility_master', function (Blueprint $table) {
            // Primary key
            $table->bigIncrements('id');

            // Core fields
            $table->string('name', 100)
                  ->unique()
                  ->comment('Special training facility name');

            $table->smallInteger('rank')
                  ->nullable()
                  ->comment('Rank or display order');

            $table->smallInteger('status')
                  ->default(1)
                  ->comment('1 = Active, 0 = Inactive');

            // Audit fields
            $table->timestamps(); // created_at, updated_at
            $table->softDeletes();
            // Index for quick lookups by status and rank
            $table->index(['status', 'rank'], 'idx_bs_training_facility_status_rank');
        });
    }

    /**
     * Reverse the migrations.
     *
     * Drops the bs_special_training_facility_master table.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('bs_special_training_facility_master');
    }
};

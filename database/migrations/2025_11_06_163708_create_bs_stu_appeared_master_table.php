<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration: Create the bs_stu_appeared_master table
 *
 * This table stores student exam appearance statuses
 * (e.g., Promoted/Passed, Detained/Repeater, etc.)
 *
 * Columns:
 *  - id: Primary key
 *  - name: Description / label
 *  - rank: Optional ordering (mapped from sl_no)
 *  - status: 1 = active, 0 = inactive
 *  - created_at / updated_at: Automatic timestamps
 *
 * Indexes:
 *  - Composite index on (status, rank)
 */
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bs_stu_appeared_master', function (Blueprint $table) {
            // Primary key
            $table->bigIncrements('id');

            // Core fields
            $table->string('name', 255)->comment('Appearance description');
            $table->smallInteger('rank')->nullable()->comment('Ordering (from sl_no)');
            $table->smallInteger('status')->default(1)->comment('1 = Active, 0 = Inactive');

            // Audit fields
            $table->timestamps(); // created_at, updated_at
        
            $table->softDeletes();
            // Index for quick lookups by status and rank
            $table->index(['status', 'rank'], 'idx_bs_stu_appeared_status_rank');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bs_stu_appeared_master');
    }
};

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
        Schema::create('bs_social_category_master', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 100)->unique()->comment('Category name');
            $table->smallInteger('status')->default(1)->comment('1 = active, 0 = inactive');
            
            // Additional fields
            $table->smallInteger('rank')->nullable()->comment('Rank value (int2)');
            $table->smallInteger('udise_active_status')->nullable()->comment('UDISE active status (int2)');
            $table->smallInteger('udise_tch_active_status')->nullable()->comment('UDISE teacher active status (int2)');
            $table->smallInteger('udise_code')->nullable()->comment('UDISE code (int2)');

            // Audit fields (timestamps only — no soft deletes)
            $table->timestamps();
            $table->softDeletes();
            // Indexes
            $table->index(['status', 'name']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bs_social_category_master');
    }
};

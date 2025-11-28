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
        Schema::create('bs_blood_group_master', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 50)->unique()->comment('Blood group name, e.g., A+, O-');
            $table->smallInteger('status')->default(1) ->comment('1 = active, 0 = inactive');
            // Audit fields
            $table->timestamps();     // created_at, updated_at with timezone
            $table->softDeletes();    // deleted_at for soft deletes
            // Indexes
            $table->index(['status', 'name']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bs_blood_group_master');
    }
};

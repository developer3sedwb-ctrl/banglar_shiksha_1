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
        Schema::create('bs_curriculum_followed_master', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 100)->unique()->comment('Current Academic Year School Status Master');
            $table->smallInteger('status')->default(1)->comment('1 = active, 0 = inactive');
            // Audit fields
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
        Schema::dropIfExists('bs_curriculum_followed_master');
    }
};

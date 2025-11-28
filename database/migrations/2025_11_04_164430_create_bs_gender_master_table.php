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
        Schema::create('bs_gender_master', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 50)->unique()->comment('Gender name');
            $table->char('gender_abb', 1)->unique()->comment('Gender abbreviation');
            $table->smallInteger('status')->default(1)->comment('1 = active, 0 = inactive');
            // Audit fields
            $table->timestamps();
            
            $table->softDeletes();
            // Indexes
            $table->index(['status', 'name', 'gender_abb']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bs_gender_master');
    }
};

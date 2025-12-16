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
        Schema::create('bs_district_parliamentary_master', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('district_code_fk');
            $table->foreign('district_code_fk')->references('id')->on('bs_district_master')->onDelete('cascade');
            $table->unsignedInteger('parliamentary_code_fk');
            $table->foreign('parliamentary_code_fk')->references('id')->on('bs_parliamentary_master')->onDelete('cascade');
            $table->smallInteger('status')->default(1)->comment('1 = active');
            // Audit fields
            $table->timestamps();
            
            $table->softDeletes();
            // Indexes
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bs_district_parliamentary_master');
    }
};

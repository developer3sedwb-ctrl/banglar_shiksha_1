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
        Schema::create('bs_district_assembly_master', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('district_code_fk');
            $table->foreign('district_code_fk')->references('id')->on('bs_district_master');
            $table->unsignedInteger('assembly_code_fk');
            $table->foreign('assembly_code_fk')->references('id')->on('bs_assembly_master');
            $table->smallInteger('status')->default(1)->comment('1 = active');
            // Audit fields
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bs_district_assembly_master');
    }
};

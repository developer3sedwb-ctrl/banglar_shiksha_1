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
        Schema::create('bs_school_classwise_section', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('school_code_fk');
            $table->unsignedSmallInteger('ac_year')->nullable();
            $table->unsignedBigInteger('class_code_fk');
            $table->unsignedSmallInteger('no_of_section')->default(0);

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('school_code_fk')->references('id')->on('bs_school_master');
            $table->foreign('class_code_fk')->references('id')->on('bs_class_master');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('school_master');
    }
};

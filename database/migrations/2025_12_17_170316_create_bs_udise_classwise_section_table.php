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
        Schema::create('bs_udise_classwise_section', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('school_code_fk');
            $table->char('ac_year',4)->nullable();
            $table->unsignedBigInteger('class_code_fk')->nullable();
            $table->unsignedSmallInteger('no_of_section')->nullable()->default(0);
            $table->smallInteger('status')->default(1);

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('school_code_fk')->references('id')->on('bs_school_master');
            $table->foreign('class_code_fk')->references('id')->on('bs_class_master');
            $table->index(['school_code_fk'], 'idx_school_acyear_class_section');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bs_udise_classwise_section');
    }
};

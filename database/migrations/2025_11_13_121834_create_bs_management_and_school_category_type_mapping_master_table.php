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
        Schema::create('bs_management_and_school_category_type_mapping_master', function (Blueprint $table) {
           $table->bigIncrements('id');
            $table->unsignedBigInteger('management_id')->comment('Foreign key to management type');
            $table->unsignedBigInteger('school_category_type_id')->comment('Foreign key to school category type');
            $table->smallInteger('status')->default(1);
            // Audit fields
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('management_id')
                ->references('id')
                ->on('bs_management_master')
                ->onUpdate('cascade')
                ->onDelete('restrict');
            $table->foreign('school_category_type_id')
                ->references('id')
                ->on('bs_school_category_type_master')
                ->onUpdate('cascade')
                ->onDelete('restrict');
            // Indexes
            $table->index(['status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bs_management_and_school_category_type_mapping_master');
    }
};

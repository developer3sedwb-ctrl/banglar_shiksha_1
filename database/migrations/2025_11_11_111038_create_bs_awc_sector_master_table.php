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
        Schema::create('bs_awc_sector_master', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('project_id')->comment('Reference to awc project master');
            $table->unsignedBigInteger('district_id')->comment('Reference to district master');
            $table->string('schcd', 9);
            $table->string('name', 100);

            $table->smallInteger('status')->default(1)->comment('1 = N, 2 = O, 3 = F, 5 = X');

            // Audit fields
            $table->timestamps();
            $table->softDeletes();

            // Foreign Keys
            $table->foreign('project_id')
                ->references('id')
                ->on('bs_awc_project_master')
                ->onUpdate('cascade')
                ->onDelete('restrict');

            $table->foreign('district_id')
                ->references('id')
                ->on('bs_district_master')
                ->onUpdate('cascade')
                ->onDelete('restrict');

            // Indexes
            $table->index(['project_id', 'district_id', 'status', 'name']);
            $table->unique(['project_id', 'district_id', 'schcd', 'name'], 'unique_awc_sector_per_project_district_schcd');
        });
 
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bs_awc_sector_master');
    }
};

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
        Schema::create('bs_assembly_master', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('district_id')->commented('Reference to district master')
                ->constrained('bs_district_master')
                ->onUpdate('cascade')
                ->onDelete('restrict');
            $table->string('name', 150);
            $table->smallInteger('assembly_number');
            $table->smallInteger('status')->default(1)->comment('1 = active, 0 = inactive');

            $table->timestamps();
            $table->softDeletes();

            // Indexes
            $table->index(['district_id']);
            $table->index(['name']);
            $table->index(['status']);

            // Prevent duplicate names within same district
            $table->unique(['district_id', 'name'], 'unique_assembly_per_district');
        });
    }
        /**
         * Reverse the migrations.
         */
    public function down(): void
    {
        Schema::dropIfExists('bs_assembly_master');
    }
};

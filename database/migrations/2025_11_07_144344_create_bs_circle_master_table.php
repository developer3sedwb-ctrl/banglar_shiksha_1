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
        Schema::create('bs_circle_master', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('district_id')->comment('Reference to district master');
            $table->char('schcd',6);
            $table->string('name', 100);
            $table->smallInteger('status')->default(1)->comment('1 = active, 0 = inactive');
            // Audit fields
            $table->timestamps();
            
            $table->softDeletes();
            // Foreign key relationships
            $table->foreign('district_id')
                ->references('id')
                ->on('bs_district_master')
                ->onUpdate('cascade')
                ->onDelete('restrict');
            // Indexes
            $table->index(['district_id']);
            $table->index(['status']);
            $table->index(['name']);
            $table->unique(['district_id','schcd', 'name'], 'unique_circle_per_district');});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bs_circle_master');
    }
};

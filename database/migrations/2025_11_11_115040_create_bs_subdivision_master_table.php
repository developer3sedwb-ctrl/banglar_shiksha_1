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
        Schema::create('bs_subdivision_master', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('district_id')->comment('Reference to district master');
            $table->string('schcd', 6);
            $table->string('name', 255);

            $table->smallInteger('status')->default(1)->comment('1 = N, 2 = O, 3 = F, 5 = X');

            // Audit fields
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('district_id')
                ->references('id')
                ->on('bs_district_master')
                ->onUpdate('cascade')
                ->onDelete('restrict');

            // Indexes
            $table->index(['district_id', 'status', 'name']);
            $table->unique(['district_id', 'schcd', 'name'], 'unique_subdivision_per_district_schcd');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bs_subdivision_master');
    }
};

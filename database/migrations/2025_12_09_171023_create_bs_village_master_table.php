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
        Schema::create('bs_village_master', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 100);
            $table->char('schcd',9)->nullable();
            $table->unsignedBigInteger('state_code_fk')->nullable();
            $table->foreign('state_code_fk')->references('state_code_pk')->on('bs_state_master')->onDelete('set null');
            $table->unsignedBigInteger('district_code_fk')->nullable();
            $table->foreign('district_code_fk')->references('district_code_pk')->on('bs_district_master')->onDelete('set null');
            $table->unsignedBigInteger('subdivision_code_fk')->nullable();
            $table->foreign('subdivision_code_fk')->references('subdivision_code_pk')->on('bs_subdivision_master')->onDelete('set null');
            $table->unsignedBigInteger('block_munc_corp_code_fk')->nullable();
            $table->foreign('block_munc_corp_code_fk')->references('block_munc_corp_code_pk')->on('bs_block_munc_corp_master')->onDelete('set null');
            $table->smallInteger('status')->default(1)->comment('1 = active');
            // Audit fields
            $table->timestamps();
            $table->softDeletes();
            // Indexes
            $table->index(['status', 'name']);  
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bs_village_master');
    }
};

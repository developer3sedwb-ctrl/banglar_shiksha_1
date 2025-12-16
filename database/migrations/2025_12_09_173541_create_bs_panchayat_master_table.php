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
        Schema::create('bs_panchayat_master', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 100);
            $table->unsignedBigInteger('district_code_fk');
            $table->unsignedBigInteger('block_munc_code_fk');
            $table->char('schcd',9);
            $table->char('distcd',4);
            $table->char('blkcd',6);
            $table->smallInteger('status')->default(1)->comment('1 = active');
            // Audit fields
            $table->timestamps();
            $table->softDeletes();
            // Indexes
            $table->index(['status', 'name']);          
        });
        Schema::table('bs_panchayat_master', function (Blueprint $table) {
            // Administrative Hierarchy
            $table->foreign('district_code_fk')->references('id')->on('bs_district_master');
            $table->foreign('block_munc_code_fk')->references('id')->on('bs_block_munc_corp_master');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bs_panchayat_master');
    }
};

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
        Schema::create('bs_booth_master', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 255);
            $table->unsignedBigInteger('district_code_fk');
            $table->foreign('district_code_fk')->references('id')->on('bs_district_master');
            $table->unsignedBigInteger('block_munc_code_fk')->nullable();
            $table->foreign('block_munc_code_fk')->references('id')->on('bs_block_munc_corp_master');
            $table->string('booth_code',255);
            $table->unsignedBigInteger('assembly_code_fk');
            $table->foreign('assembly_code_fk')->references('id')->on('bs_assembly_master');
            $table->unsignedBigInteger('part_no');
            $table->smallInteger('status')->default(1)->comment('1 = active');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bs_booth_master');
    }
};

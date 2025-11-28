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
        Schema::create('bs_school_medium', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('school_code_fk');
            $table->unsignedSmallInteger('medium_code_fk');
            
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('school_code_fk')->references('id')->on('bs_school_master');
            $table->foreign('medium_code_fk')->references('id')->on('bs_medium_master');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};

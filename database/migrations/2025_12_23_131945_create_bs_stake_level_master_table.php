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
        Schema::create('bs_stake_level_master', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('stake_level_abbreviation', 50);
            $table->unsignedInteger('stake_level_type_code_fk');
            $table->foreign('stake_level_type_code_fk')->references('id')->on('bs_stake_level_type_master');
            $table->char('login_stake_code', 3);
            $table->smallInteger('status')->default(1)->comment('1 = active');
            // Audit fields
            $table->timestamps();
            
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bs_stake_level_master');
    }
};

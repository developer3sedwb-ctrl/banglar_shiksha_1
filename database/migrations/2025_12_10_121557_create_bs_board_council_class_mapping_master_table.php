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
        Schema::create('bs_board_council_class_mapping_master', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('board_council_code_fk');
            $table->foreign('board_council_code_fk')->references('id')->on('bs_board_council_master')->onDelete('cascade');
            $table->unsignedInteger('class_code_fk');
            $table->foreign('class_code_fk')->references('id')->on('bs_class_master')->onDelete('cascade');
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
        Schema::dropIfExists('bs_board_council_class_mapping_master');
    }
};

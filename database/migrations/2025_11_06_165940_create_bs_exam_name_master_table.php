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
        Schema::create('bs_exam_name_master', function (Blueprint $table) {
        $table->bigIncrements('id');
        $table->unsignedBigInteger('board_council_id')->comment('Reference to board/council master');
        $table->unsignedBigInteger('class_id')->comment('Reference to class master');
        $table->string('name', 50);
        $table->smallInteger('pass_marks')->nullable()->comment('Minimum passing marks for the exam');
        $table->smallInteger('total_marks')->nullable()->comment('Total marks for the exam');
        $table->smallInteger('status')->default(1)->comment('1 = active, 0 = inactive');
        $table->timestamps();
        $table->softDeletes();

        // Foreign keys
        $table->foreign('board_council_id')
            ->references('id')
            ->on('bs_board_council_master')
            ->onUpdate('cascade')
            ->onDelete('restrict');

        $table->foreign('class_id')
            ->references('id')
            ->on('bs_class_master')
            ->onUpdate('cascade')
            ->onDelete('restrict');

        // Indexes
        $table->index(['board_council_id', 'class_id']);
        $table->index(['status']);
        $table->index(['name']); // or use unique composite below
    });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bs_exam_name_master');
    }
};

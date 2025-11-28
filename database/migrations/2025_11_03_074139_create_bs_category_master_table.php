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
        Schema::create('bs_category_master', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 100)->unique()->comment('Category name');
            $table->json('class_list')->nullable()->comment('List of associated class IDs or names');
            $table->smallInteger('status')->default(1)->comment('1 = N');
            // Default Laravel timestamps
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
        Schema::dropIfExists('bs_category_master');
    }
};

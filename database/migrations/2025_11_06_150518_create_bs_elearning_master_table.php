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
        Schema::create('bs_elearning_master', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 100)->unique()->comment('Name of the e-learning course');
            $table->string('image_link', 150)->unique()->comment('Name of the image link');
            $table->smallInteger('status')->default(1)->comment('1 = active, 0 = inactive');
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
        Schema::dropIfExists('bs_elearning_master');
    }
};

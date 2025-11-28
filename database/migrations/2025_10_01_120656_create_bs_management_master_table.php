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
        Schema::create('bs_management_master', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 100)->unique()->comment('Name of the management entity');
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
        Schema::dropIfExists('bs_management_master');
    }
};

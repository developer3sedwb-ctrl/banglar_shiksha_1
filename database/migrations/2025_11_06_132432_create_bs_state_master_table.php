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
        Schema::create('bs_state_master', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 100)->unique()->comment('State name');
            $table->char('schcd', 2)->unique();
            $table->smallInteger('status')->default(1)->comment('1 = N, 2 = O, 3 = F, 5 = X');
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
        Schema::dropIfExists('bs_state_master');
    }
};

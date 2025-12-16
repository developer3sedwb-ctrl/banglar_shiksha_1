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
        Schema::create('bs_bank_branch_master', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 255);
            $table->string('bank_name', 100);
            $table->string('bank_ifsc', 11);
            $table->string('bank_micr', 12)->nullable();
            $table->text('address')->nullable();
            $table->string('contact', 15)->nullable();
            $table->string('city', 50)->nullable();
            $table->string('district', 50)->nullable();
            $table->string('state', 50)->nullable();
            $table->smallInteger('state_code_fk')->nullable();
            $table->string('bank_code', 5)->nullable();
            $table->string('bank_code_fk', 11);
            $table->for('bank_code_fk', 11);
            // Audit fields
            $table->timestamps();
            
            $table->softDeletes();
            // Indexes
            $table->index(['status', 'bank_ifsc'], 'idx_status_bank_ifsc');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bs_bank_branch_master');
    }
};

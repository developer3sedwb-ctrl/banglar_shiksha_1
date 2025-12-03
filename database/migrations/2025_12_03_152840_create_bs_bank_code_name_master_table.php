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
        Schema::create('bs_bank_code_name_master', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 50);
            $table->char('bank_code', 6);
            $table->string('bank_ifsc', 20);
            $table->string('digit_in_account_no', 50);
            $table->smallInteger('status')->default(1)->comment('1 = active');
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
        Schema::dropIfExists('bs_bank_code_name_master');
    }
};

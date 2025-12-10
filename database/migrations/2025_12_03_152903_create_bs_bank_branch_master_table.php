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
            $table->unsignedBigInteger('bank_id_fk');
            $table->foreign('bank_id_fk')->references('id')->on('bs_bank_code_name_master')->onDelete('cascade');
            $table->string('bank_name', 100);
            $table->char('bank_code', 6)->nullable();
            $table->char('branch_ifsc', 11);
            $table->text('address')->nullable();
            $table->string('contact', 15)->nullable();
            $table->string('city', 50)->nullable();
            $table->string('district', 50)->nullable();
            $table->string('state', 50)->nullable();
            $table->smallInteger('status')->default(1)->comment('1 = active');
            // Audit fields
            $table->timestamps();
            
            $table->softDeletes();
            // Indexes
            $table->index(['status', 'branch_ifsc'], 'idx_status_bank_branch_ifsc');
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

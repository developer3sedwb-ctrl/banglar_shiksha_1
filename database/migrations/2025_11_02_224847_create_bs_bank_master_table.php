<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
    {
        Schema::create('bs_bank_master', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 100);
            $table->string('branch_name', 100);
            $table->char('bank_code', 4);
            $table->char('ifsc_code', 11)->unique();
            $table->smallInteger('account_digits');
            $table->smallInteger('status')->default(1)->comment('1 = active, 0 = inactive');
            // Default Laravel timestamps (created_at, updated_at)
            $table->timestamps();
            $table->softDeletes(); // adds deleted_at for soft delete
            // Indexes
            $table->index(['status', 'name']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('bs_bank_master');
    }
};

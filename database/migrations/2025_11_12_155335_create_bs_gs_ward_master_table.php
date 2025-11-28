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
        Schema::create('bs_gs_ward_master', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 100)->comment('Gp/Ward name');
            $table->unsignedBigInteger('block_munc_corp_id')->comment('Block/Municipality Code Foreign Key');
            $table->char('schcd', 9);
            $table->smallInteger('status')->default(1);
            // Audit fields
            $table->timestamps();
            
            $table->softDeletes();
            $table->foreign('block_munc_corp_id')
                ->references('id')
                ->on('bs_block_munc_corp_master')
                ->onUpdate('cascade')
                ->onDelete('restrict');
            // Indexes
            $table->index(['block_munc_corp_id', 'status','name']);
            $table->unique(['block_munc_corp_id','schcd','name'], 'unique_gs_ward_per_block');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bs_gs_ward_master');
    }
};

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
        Schema::create('bs_cluster_master', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 100)->comment('Cluster Name');
            $table->unsignedBigInteger('district_id')->comment('District Code Foreign Key');
            $table->unsignedBigInteger('block_munc_corp_id')->nullable()->comment('Block/Municipality/Corporation Code Foreign Key');
            $table->string('schcd', 10);
            $table->smallInteger('status')->default(1)->comment('1 = N, 2 = O, 3 = F, 4 = Y, 5 = X');
            // Audit fields
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('district_id')
                ->references('id')
                ->on('bs_district_master')
                ->onUpdate('cascade')
                ->onDelete('restrict');
            $table->foreign('block_munc_corp_id')
                ->references('id')
                ->on('bs_block_munc_corp_master')
                ->onUpdate('cascade')
                ->onDelete('restrict');
            // Indexes
            $table->index(['district_id','status', 'name']);
            $table->unique(['district_id','schcd', 'name'], 'unique_cluster_per_district_schcd');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bs_cluster_master');
    }
};

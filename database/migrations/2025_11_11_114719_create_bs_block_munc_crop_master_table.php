<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
     Schema::create('bs_block_munc_corp_master', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('district_id')->comment('Reference to district master');
            $table->unsignedBigInteger('subdivision_id')->nullable()->comment('Reference to subdivision master');
            $table->string('schcd', 6);
            $table->string('name', 100);
            $table->char('type', 1)->comment('B = Block, M = Municipality , C = Corporation');

            $table->smallInteger('status')->default(1)->comment('1 = N, 2 = O, 3 = F, 4 = Y, 5 = X');

            // Audit fields
            $table->timestamps();
            $table->softDeletes();

            // Foreign Keys
            $table->foreign('subdivision_id')
                ->references('id')
                ->on('bs_subdivision_master')
                ->onUpdate('cascade')
                ->onDelete('restrict');

            $table->foreign('district_id')
                ->references('id')
                ->on('bs_district_master')
                ->onUpdate('cascade')
                ->onDelete('restrict');

            // Indexes
            $table->index(['subdivision_id', 'district_id', 'status', 'name']);
            $table->unique(['subdivision_id', 'district_id', 'schcd', 'name','status'], 'unique_block_munc_corp_per_subdiv_district_schcd_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bs_block_munc_corp_master');
    }
};

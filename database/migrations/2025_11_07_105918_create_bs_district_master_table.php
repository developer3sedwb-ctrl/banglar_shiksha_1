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
    Schema::create('bs_district_master', function (Blueprint $table) {
        $table->bigIncrements('id');

        // Foreign key to state master
        $table->unsignedBigInteger('state_id')->comment('Reference to state master');

        // Basic district info
        $table->char('schcd', 4);
        $table->string('name', 100);
        $table->smallInteger('district_type')->default(1)->comment('1 = General, 2 = Education');
        // Administrative fields
        $table->char('ddo_code', 9)->nullable()->comment('DDO code for education district');
        $table->string('treasury_code', 50)->nullable()->comment('Treasury code for education district');
        $table->smallInteger('status')->default(1)->comment('1 = active, 0 = inactive');

        $table->timestamps();
        $table->softDeletes();

        // Foreign key relationships
        $table->foreign('state_id')
            ->references('id')
            ->on('bs_state_master')
            ->onUpdate('cascade')
            ->onDelete('restrict');

        // Indexes
        $table->index(['state_id']);
        $table->index(['district_type']);
        $table->index(['status']);
        $table->index(['name']);
        $table->unique(['state_id', 'name', 'district_type'], 'unique_district_per_state_type');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bs_district_master');
    }
};

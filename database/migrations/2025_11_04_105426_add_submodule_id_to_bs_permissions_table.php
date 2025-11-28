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
        Schema::table('bs_permissions', function (Blueprint $table) {
            $table->foreignId('submodule_id')
                ->nullable()
                ->constrained('bs_modules')  // assuming 'modules' table exists
                ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bs_permissions', function (Blueprint $table) {
            $table->dropConstrainedForeignId('submodule_id');
        });
    }
};

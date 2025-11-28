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
        Schema::create('bs_permissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('role_id')->constrained('bs_roles')->onDelete('cascade');
            $table->foreignId('module_id')->constrained('bs_modules')->onDelete('cascade');
            $table->boolean('can_view_module')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bs_permissions');
    }
};

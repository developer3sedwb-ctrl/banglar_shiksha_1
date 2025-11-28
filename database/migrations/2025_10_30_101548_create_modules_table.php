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
        Schema::create('bs_modules', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('shortcode');
            $table->integer('orderby')->default(0);

            $table->timestamps();

            $table->foreignId('parent_module_id')
                ->nullable()
                ->constrained('bs_modules')
                ->nullOnDelete();

            // ✅ Composite unique constraints
            $table->unique(['parent_module_id', 'name']);
            $table->unique(['parent_module_id', 'shortcode']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bs_modules');
    }
};

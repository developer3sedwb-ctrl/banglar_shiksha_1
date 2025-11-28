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
        Schema::create('bs_error_logs', function (Blueprint $table) {

            $table->bigIncrements('id');
            // Which query caused the error
            $table->longText('query')->nullable();
            // Bindings used in the query
            $table->json('bindings')->nullable();
            // The actual DB error message
            $table->text('error_message');
            // Optional: SQLSTATE error code (e.g. 23505)
            $table->string('error_code', 10)->nullable();
            // File and line where the error occurred
            $table->string('file')->nullable();
            $table->integer('line')->nullable();
            // Request info (optional but very useful)
            $table->string('url')->nullable();
            $table->string('method', 10)->nullable();
            $table->ipAddress('ip')->nullable();
            // If user logged in
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bs_error_logs');
    }
};

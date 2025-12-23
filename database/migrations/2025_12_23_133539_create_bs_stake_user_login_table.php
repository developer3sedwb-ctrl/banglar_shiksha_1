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
        Schema::create('bs_stake_user_login', function (Blueprint $table) {

            $table->bigIncrements('id');

            // ---- Core fields ----
            $table->unsignedBigInteger('stake_level_code_fk')->nullable();
            $table->string('stake_password', 100)->nullable();
            $table->timestamp('entry_time', 6)->nullable();
            $table->string('entry_ip', 15)->nullable();

            $table->unsignedBigInteger('location_master_code_fk')->nullable();

            $table->string('stake_user', 11)->notNullable();
            $table->integer('stake_credential_flag')->nullable();

            $table->unsignedBigInteger('stake_user_public')->notNullable();

            $table->unsignedBigInteger('stake_level_type_code_fk')->nullable();
            $table->string('login_stake_code', 3)->nullable();

            $table->char('login_status', 1)->default('0');
            $table->char('default_password_change', 1)->default('0');

            $table->timestamp('last_login', 6)->nullable();

            // ---- Update audit ----
            $table->string('update_ip', 15)->nullable();
            $table->timestamp('update_time', 6)->nullable();
            $table->integer('update_by')->nullable();
            $table->integer('update_by_stake_cd')->nullable();

            // ---- Laravel audit ----
            $table->timestamps();
            $table->softDeletes();

            // ---- Indexes ----
            $table->index('stake_user');
            $table->index('stake_level_code_fk');
            $table->index('stake_level_type_code_fk');
            $table->index('login_stake_code');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bs_stake_user_login');
    }
};

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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('full_name')->nullable(false);
            $table->string('service_name')->nullable(false);
            $table->string('military_rank')->nullable(false);
            $table->string('military_unit')->nullable(false);
            $table->string('electronic_signature')->nullable(false);
            $table->string('name')->nullable(false);
            $table->string('email')->unique()->nullable(false);
      $table->string('phone')->nullable(false);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable(false);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};

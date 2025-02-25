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
        Schema::create('harf_staff', function (Blueprint $table) {
            $table->id();
            $table->foreignId('departament_id')->constrained();
            $table->string('name')->nullable(false);
            $table->string('email')->unique()->nullable();
            $table->string('phone')->unique()->nullable(false);
            $table->string('extension')->unique()->nullable();
            $table->boolean('military')->nullable(false);
            $table->integer('electronic_signature')->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('harf_staff');
    }
};

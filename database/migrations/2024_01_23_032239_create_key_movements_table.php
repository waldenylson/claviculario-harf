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
        Schema::create('key_movements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('key_id')->constrained();
            $table->foreignId('harf_staff_id')->constrained();
            $table->string('movement_type')->nullable(false);
            $table->dateTime('out')->nullable(false);
            $table->dateTime('return')->nullable();
            $table->text('comments')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('key_movements');
    }
};

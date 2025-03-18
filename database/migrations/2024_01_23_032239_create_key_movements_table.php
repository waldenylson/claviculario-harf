<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::create('key_movements', function (Blueprint $table) {
      $table->id();
      $table->foreignId('key_id')->constrained('keys', 'id');
      $table->foreignId('harf_staff_id')->constrained('harf_staff', 'id');
      $table->foreignId('user_id')->constrained('users', 'id');
      $table->string('movement_type')->nullable(false);
      $table->string('movement')->nullable();
      $table->timestamp('out')->nullable(false)->useCurrent();
      $table->timestamp('return')->nullable()->useCurrent();
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

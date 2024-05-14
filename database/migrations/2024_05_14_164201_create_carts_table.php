<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up(): void
  {
    Schema::create('carts', function (Blueprint $table) {
      $table->id();
      $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
      $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
      $table->unsignedInteger('quantity')->default(1)->nullable(false)->min(1)->max(50);
      $table->timestamps();
    });
  }

  public function down(): void
  {
    Schema::dropIfExists('carts');
  }
};
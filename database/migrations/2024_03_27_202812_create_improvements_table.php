<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImprovementsTable extends Migration
{
  public function up(): void
  {
    Schema::create('improvements', function (Blueprint $table) {
      $table->id();
      $table->string('name');
      $table->string('email')->nullable();
      $table->text('suggestion_comment');
      $table->timestamps();
    });
  }

  public function down(): void
  {
    Schema::dropIfExists('improvements');
  }
}
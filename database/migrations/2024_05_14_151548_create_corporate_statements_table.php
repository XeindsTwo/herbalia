<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCorporateStatementsTable extends Migration
{
  public function up()
  {
    Schema::create('corporate_statements', function (Blueprint $table) {
      $table->id();
      $table->string('name');
      $table->string('phone');
      $table->string('email');
      $table->string('company');
      $table->timestamps();
    });
  }

  public function down()
  {
    Schema::dropIfExists('corporate_statements');
  }
}
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('posts', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('rubric_id')->nullable();
      $table->foreign('rubric_id')->references('id')->on('rubrics');
      $table->unsignedBigInteger('user_id');
      $table->foreign('user_id')->references('id')->on('users');
      //$table->foreignId('user_id')->constrained('users');
      $table->string('metatitle')->nullable();
      $table->string('keywords')->nullable();
      $table->string('description')->nullable();
      $table->string('robots',20)->nullable();
      $table->string('name');
      $table->string('slug');
      $table->string('tagline')->nullable();
      $table->text('excerpt')->nullable();
      $table->longText('body')->fullText()->nullable();
      $table->string('preview',100)->nullable();
      $table->string('picture',100)->nullable();
      $table->string('tags')->nullable();
      $table->char('lang',2)->nullable();
      $table->boolean('status')->default(false);
      $table->timestamps();
      $table->index('slug');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::dropIfExists('posts');
  }
};

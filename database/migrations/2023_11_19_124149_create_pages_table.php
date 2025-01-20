<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->integer('parent_id')->nullable();
            $table->string('metatitle')->nullable();
            $table->string('keywords')->nullable();
            $table->string('description')->nullable();
            $table->string('robots')->nullable();
            $table->string('title');
            $table->string('slug');
            $table->string('subtitle')->nullable();
            $table->text('text')->fullText()->nullable();
            $table->string('image',50)->nullable();
            $table->text('custom')->fullText()->nullable();
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
    public function down()
    {
        Schema::dropIfExists('pages');
    }
};

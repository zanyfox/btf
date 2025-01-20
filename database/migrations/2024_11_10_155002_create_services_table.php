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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->integer('parent_id')->nullable();
            $table->string('metatitle')->nullable();
            $table->string('keywords')->nullable();
            $table->string('description')->nullable();
            $table->string('robots')->nullable();
            $table->string('name');
            $table->string('slug');
            $table->string('tagline')->nullable();
            $table->text('body')->fullText()->nullable();
            $table->string('cover')->nullable();
            $table->string('picture')->nullable();
            $table->text('custom')->fullText()->nullable();
            $table->char('lang',2)->nullable();
            $table->decimal('price', 10, 0)->nullable();
            $table->integer('order_by')->nullable();
            $table->boolean('status')->default(false)->comment('0 - не опубликовано, 1 - опубликовано');
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
        Schema::dropIfExists('services');
    }
};

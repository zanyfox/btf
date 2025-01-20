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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('meta_title')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('meta_robots', 100)->nullable();
            $table->string('name');
            $table->string('slug');
            $table->string('subtitle')->nullable();
            $table->text('excerpt')->nullable();
            $table->longText('description')->nullable();
            $table->string('picture')->nullable();
            $table->char('lang',2)->nullable();
            $table->integer('parent_id')->nullable();
            $table->unsignedInteger('color_id')->nullable();
            $table->integer('order_by')->nullable();
            $table->boolean('status')->default(true);
            $table->string('name_en')->nullable();
            $table->longText('description_en')->fullText()->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
};

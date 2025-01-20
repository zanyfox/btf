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
        Schema::create('attributes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->nullable();
            $table->string('group')->nullable();
            $table->char('lang',2)->default('ru');
            $table->boolean('status')->default(true);
            $table->timestamps();
        });

        Schema::create('attribute_good', function (Blueprint $table) {
            $table->integer('attribute_id')->unsigned();
            $table->integer('good_id')->unsigned();
            $table->string('value')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attributes');
        Schema::dropIfExists('attribute_good');
    }
};

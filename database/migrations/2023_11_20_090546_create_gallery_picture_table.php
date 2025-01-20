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
        Schema::create('gallery_picture', function (Blueprint $table) {
            //$table->id();
            /* $table->unsignedBigInteger('gallery_id');
            $table->foreign('gallery_id')->references('id')->on('galleries');
            $table->unsignedBigInteger('picture_id');
            $table->foreign('picture_id')->references('id')->on('pictures'); */
            $table->foreignId('gallery_id')->constrained();
            $table->foreignId('picture_id')->constrained();
            //$table->foreignId('gallery_id')->constrained('galleries');
            //$table->foreignId('picture_id')->constrained('pictures');
            //$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gallery_picture');
    }
};

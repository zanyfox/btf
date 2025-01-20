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
        Schema::create('good_ratings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('good_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('email');
            $table->string('comment');
            $table->double('rating',3,2);
            $table->tinyInteger('status')->default(0);
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
        Schema::dropIfExists('good_ratings');
    }
};

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
        Schema::create('customer_addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('name')->nullable();
            $table->string('surname')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->foreignId('country_id')->constrained()->onDelete('cascade');
            /* $table->unsignedBigInteger('country_id');
            $table->foreign('country_id')->references('id')->on('countries'); */
            $table->string('region',100)->nullable();
            $table->string('city',100)->nullable();
            $table->string('street',100)->nullable();
            $table->string('house',10)->nullable();
            $table->string('building',10)->nullable();
            $table->string('entrance',10)->nullable();
            $table->string('floor',10)->nullable();
            $table->string('flat',10)->nullable();
            $table->string('doorphone',10)->nullable();
            $table->string('zip')->nullable();
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
        Schema::dropIfExists('customer_addresses');
    }
};

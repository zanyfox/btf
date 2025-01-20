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
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('code', 8);
            $table->string('name',30)->nullable();
            $table->text('description')->nullable();
            $table->enum('type', ['percent','fixed'])->default('fixed');
            $table->double('value');
            $table->unsignedTinyInteger('currency_id')->nullable();
            $table->unsignedTinyInteger('only_once')->default(0);
            $table->double('min_sum')->nullable();
            $table->unsignedTinyInteger('status')->default(1);
            $table->timestamp('started_at')->nullable();
            $table->timestamp('expired_at')->nullable();
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
        Schema::dropIfExists('coupons');
    }
};

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
        Schema::create('item_modifiers', function (Blueprint $table) {
            //$table->foreignId('item_id')->constrained()->onDelete('cascade');
            //$table->foreignId('modifier_id')->constrained()->onDelete('cascade');
            $table->integer('item_id');
            $table->integer('modifier_id');
            $table->integer('amount')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('item_modifiers');
    }
};

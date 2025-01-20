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
    public function up() {
        Schema::create('modifiers', function (Blueprint $table) {
            $table->string('id')->index();
            $table->integer('good_id',11)->index();
            $table->string('group_id')->nullable();
            $table->integer('defaultAmount')->default(0);
            $table->integer('minAmount')->default(0);
            $table->integer('maxAmount')->default(0);
            $table->boolean('required')->default(false);
            $table->boolean('hideIfDefaultAmount')->default(false);
            $table->boolean('splittable')->default(false);
            $table->integer('freeOfChargeAmount')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('modifiers');
    }
};

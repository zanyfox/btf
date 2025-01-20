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
        Schema::create('goods', function (Blueprint $table) {
            $table->id();
            $table->string('meta_title')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('meta_robots', 100)->nullable();
            $table->string('name');
            $table->string('slug')->index();
            $table->string('subtitle')->nullable();
            $table->text('excerpt')->nullable();
            $table->longText('description')->fullText()->nullable();
            $table->longText('custom')->nullable();
            $table->text('related_goods')->nullable();
            $table->string('picture',100)->nullable();
            $table->decimal('price', 10, 0)->default(0);
            $table->decimal('oldprice', 10, 0)->default(0);
            $table->integer('discount')->nullable();
            $table->integer('order_by')->nullable();
            $table->char('lang',2)->nullable();
            $table->string('tags',255)->nullable();
            $table->integer('brand_id')->nullable();
            /* $table->unsignedBigInteger('brand_id');
            $table->foreign('brand_id')->references('id')->on('brands'); */
            $table->string('sku',100)->nullable();
            $table->string('barcode',100)->nullable();
            $table->string('code',100)->nullable();
            $table->string('external_id',100)->nullable();
            $table->enum('track_qty', ['Y','N'])->default('N');
            $table->unsignedInteger('quantity')->default(0);
            $table->boolean('available')->default(true);
            $table->string('type',50)->nullable();
            $table->string('order_item_type',50)->nullable();
            $table->boolean('status')->default(false);
            $table->enum('featured', ['Y','N'])->default('Y');
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
        Schema::dropIfExists('goods');
    }
};

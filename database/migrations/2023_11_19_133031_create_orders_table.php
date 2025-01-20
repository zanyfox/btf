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
    Schema::create('orders', function (Blueprint $table) {
      $table->id();

      $table->foreignId('user_id')->constrained()->onDelete('cascade');
      $table->string('tracking_no')->nullable();
      $table->decimal('subtotal', 10, 0);
      $table->decimal('shipping', 10, 0);
      $table->decimal('grand_total', 10, 0);
      $table->string('coupon_code')->nullable();
      $table->double('discount', 10, 0)->nullable();
      $table->string('name')->nullable();
      $table->string('surname')->nullable();
      $table->string('email')->nullable();
      $table->string('phone')->nullable();
      $table->integer('country_id')->nullable();
      //$table->unsignedBigInteger('country_id');
      //$table->foreign('country_id')->references('id')->on('countries');
      $table->string('pincode')->nullable();
      $table->mediumText('address')->nullable();
      $table->string('apartment')->nullable();
      $table->string('city')->nullable();
      $table->string('region')->nullable();
      $table->string('zip')->nullable();
      $table->text('notes')->nullable();
      $table->string('status')->default('new');
      $table->string('payment_mode')->nullable();
      $table->integer('payment_id')->nullable();
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
    Schema::dropIfExists('orders');
  }
};

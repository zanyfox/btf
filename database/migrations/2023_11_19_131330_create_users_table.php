<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('users', function (Blueprint $table)
        {
            $table->id();
            $table->string('name', 100)->nullable();
            $table->string('surname', 100)->nullable();
            $table->string('phone', 20)->nullable();//->unique()
            $table->string('email', 100)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->boolean('is_admin')->default(false);
            $table->string('picture', 100)->nullable();
            $table->string('address')->nullable();
            $table->string('city', 100)->nullable();
            $table->string('state', 100)->nullable();
            $table->string('postcode', 100)->nullable();
            $table->string('country', 100)->nullable();
            $table->boolean('marketingoptin')->default(false);
            $table->timestamp('birthdate')->nullable();
            $table->boolean('agree')->nullable();
            $table->string('device_key', 255)->nullable();
            $table->boolean('status')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};

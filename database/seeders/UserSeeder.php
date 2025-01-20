<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class UserSeeder extends Seeder {

  public function run() {

    $faker = Faker::create();
    foreach (range(1,10) as $value) {
      DB::table('users')->insert([
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail(),
        'email_verified_at' => now(),
        'password' => Hash::make($faker->password()),
        'remember_token' => Str::random(10),
        'is_admin' => false,
        'picture' => null
      ]);
    }
    
  }

}
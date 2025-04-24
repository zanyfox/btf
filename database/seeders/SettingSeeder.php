<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder {
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run() {
    DB::table('settings')->insert([
      [
        'name' => 'Название приложения',
        'key' => 'appname',
        'value' => 'My App',
        'lang' => null,
        'status' => true,
      ],
      [
        'name' => 'Сайт',
        'key' => 'site',
        'value' => 'https://example.com',
        'lang' => null,
        'status' => true,
      ],
      [
        'name' => 'Телефон',
        'key' => 'phone',
        'value' => '+7 (999) 999-99-99',
        'lang' => null,
        'status' => true,
      ],
      [
        'name' => 'Email',
        'key' => 'email',
        'value' => 'VxHt6@example.com',
        'lang' => null,
        'status' => true,
      ],
    ]);
  }
}

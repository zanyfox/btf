<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Cocur\Slugify\Slugify;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class GoodFactory extends Factory {
  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition(): array {
    $fakeName = $this->faker->unique()->name();
    $slugify = new Slugify();
    $fakeSlug = $slugify->slugify($fakeName);
    $brandsId = \App\Models\Brand::pluck('id')->toArray();

    $categoriesId = \App\Models\Category::pluck('id')->toArray();
    $categoryRandomKey = array_rand($categoriesId);
    $categoryId = $categoriesId[$categoryRandomKey];

    return [
      'name' => $fakeName,
      'slug' => $fakeSlug,
      'description' => $this->faker->sentence,
      'brand_id' => $this->faker->randomElement($brandsId),
      'price' => rand(100, 10000)
    ];
  }
}

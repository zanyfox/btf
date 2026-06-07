<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Cocur\Slugify\Slugify;

class GoodFactory extends Factory {

  public function definition(): array {

    $name = $this->faker->unique()->name();
    $slugify = new Slugify();
    $slug = $slugify->slugify($name);
    $brandsId = \App\Models\Brand::pluck('id')->toArray();
    if (empty($brandsId)) {
      $brandsId = [1]; // Default brand ID if no brands exist
    }
    $status = $this->faker->enum(['draft', 'published', 'archived'])->default('draft');
    switch ($status) {
      case 'draft':
        $status = 0;
        break;
      case 'published':
        $status = 1;
        break;
      case 'archived':
        $status = 2;
        break;
      default:
        $status = 0; // Default to draft if no match
        break;
    }

    $categoriesId = \App\Models\Category::pluck('id')->toArray();
    $categoryRandomKey = array_rand($categoriesId);
    $categoryId = $categoriesId[$categoryRandomKey];

    return [
      'name' => $name,
      'slug' => $slug,
      'description' => $this->faker->sentence,
      'brand_id' => $this->faker->randomElement($brandsId),
      'price' => rand(100, 10000)
    ];
  }
}

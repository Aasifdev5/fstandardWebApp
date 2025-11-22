<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;
use App\Models\Category;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory {
    protected $model = Product::class;

    public function definition() {
        return [
            'category_id' => Category::inRandomOrder()->first()->id ?? 1, // Ensure a category exists
            'code' => strtoupper($this->faker->unique()->bothify('??###')),
            'name' => $this->faker->word(),
            'description' => $this->faker->sentence(),
            'image' => $this->faker->imageUrl(200, 200, 'products'),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}

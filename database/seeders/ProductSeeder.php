<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
class ProductSeeder extends Seeder {
    public function run() {
        Product::factory(20)->create(); // Generate 20 fake products
    }
}

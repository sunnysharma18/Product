<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder {
    public function run() {
        Product::create(['name' => 'Laptop', 'description' => 'Gaming Laptop', 'price' => 1200.99, 'stock' => 10]);
    }
}

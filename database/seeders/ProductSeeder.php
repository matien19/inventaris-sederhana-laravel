<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'name' => 'Laptop Asus ROG',
            'description' => 'Laptop gaming terbaik',
            'sku' => 'ss=pd',
            'price' => 25000000,
            'stock' => 10,
            'category_id' => 1,
        ]);
    }
}

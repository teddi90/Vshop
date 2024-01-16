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
           'title'=>'Lorem impson',
            'price'=>19.03,
            'quantity'=>3,
            'category_id'=>1,
            'brand_id'=>1,
            'description'=>'Lorem impson asdf kor lorem s afgh impsuoms hallead fg h'

        ]);
    }
}

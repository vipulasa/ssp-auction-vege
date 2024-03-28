<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'category_id' => 1,
                'name' => 'Apple',
                'slug' => 'apple',
                'description' => 'An apple is an edible fruit produced by an apple tree.',
                'meta_title' => 'Apple',
                'meta_description' => 'An apple is an edible fruit produced by an apple tree.',
                'meta_keywords' => 'apple, fruit',
                'price' => '1.99'
            ],
            [
                'category_id' => 1,
                'name' => 'Banana',
                'slug' => 'banana',
                'description' => 'A banana is an elongated, edible fruit – botanically a berry – produced by several kinds of large herbaceous flowering plants in the genus Musa.',
                'meta_title' => 'Banana',
                'meta_description' => 'A banana is an elongated, edible fruit – botanically a berry – produced by several kinds of large herbaceous flowering plants in the genus Musa.',
                'meta_keywords' => 'banana, fruit',
                'price' => '2.99'
            ],
            [
                'category_id' => 1,
                'name' => 'Orange',
                'slug' => 'orange',
                'description' => 'The orange is the fruit of various citrus species in the family Rutaceae.',
                'meta_title' => 'Orange',
                'meta_description' => 'The orange is the fruit of various citrus species in the family Rutaceae.',
                'meta_keywords' => 'orange, fruit',
                'price' => '3.99'
            ],
            [
                'category_id' => 2,
                'name' => 'Carrot',
                'slug' => 'carrot',
                'description' => 'The carrot is a root vegetable, usually orange in color, though purple, black, red, white, and yellow cultivars exist.',
                'meta_title' => 'Carrot',
                'meta_description' => 'The carrot is a root vegetable, usually orange in color, though purple, black, red, white, and yellow cultivars exist.',
                'meta_keywords' => 'carrot, vegetable',
                'price' => '4.99'
            ],
            [
                'category_id' => 2,
                'name' => 'Cucumber',
                'slug' => 'cucumber',
                'description' => 'Cucumber is a widely-cultivated creeping vine plant in the Cucurbitaceae gourd family that bears cucumiform fruits, which are
                used as vegetables.',
                'meta_title' => 'Cucumber',
                'meta_description' => 'Cucumber is a widely-cultivated creeping vine plant in the Cucurbitaceae gourd family that bears cucumiform fruits, which are
                used as vegetables.',
                'meta_keywords' => 'cucumber, vegetable',
                'price' => '5.99'
            ]
        ];

        foreach ($products as $product) {
            \App\Models\Product::create($product);
        }
    }
}

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
                'price' => '1.99',
                'image' => 'https://s3.eu-central-1.amazonaws.com/cdn.nowa.market/media/663/conversions/photos-produits(3)-product_thumb.jpg'
            ],
            [
                'category_id' => 1,
                'name' => 'Banana',
                'slug' => 'banana',
                'description' => 'A banana is an elongated, edible fruit – botanically a berry – produced by several kinds of large herbaceous flowering plants in the genus Musa.',
                'meta_title' => 'Banana',
                'meta_description' => 'A banana is an elongated, edible fruit – botanically a berry – produced by several kinds of large herbaceous flowering plants in the genus Musa.',
                'meta_keywords' => 'banana, fruit',
                'price' => '2.99',
                'image' => 'https://s3.eu-central-1.amazonaws.com/cdn.nowa.market/media/483/conversions/Banane-BIO-product_thumb.jpg',
            ],
            [
                'category_id' => 1,
                'name' => 'Orange',
                'slug' => 'orange',
                'description' => 'The orange is the fruit of various citrus species in the family Rutaceae.',
                'meta_title' => 'Orange',
                'meta_description' => 'The orange is the fruit of various citrus species in the family Rutaceae.',
                'meta_keywords' => 'orange, fruit',
                'price' => '3.99',
                'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQrS4lHXOepaPm-0FgmXCi0uUHlNmIU6RLHuewIeC8Ttg&s'
            ],
            [
                'category_id' => 2,
                'name' => 'Carrot',
                'slug' => 'carrot',
                'description' => 'The carrot is a root vegetable, usually orange in color, though purple, black, red, white, and yellow cultivars exist.',
                'meta_title' => 'Carrot',
                'meta_description' => 'The carrot is a root vegetable, usually orange in color, though purple, black, red, white, and yellow cultivars exist.',
                'meta_keywords' => 'carrot, vegetable',
                'price' => '4.99',
                'image' => 'https://m.media-amazon.com/images/I/51mUwdp2THL._AC_UF1000,1000_QL80_.jpg'
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
                'price' => '5.99',
                'image' => 'https://m.media-amazon.com/images/I/71xkI-PIE5L.jpg'
            ]
        ];

        foreach ($products as $product) {

            // take the image out
            $image = $product['image'];

            // remove the image from the product array
            unset($product['image']);


            $product_model = \App\Models\Product::create($product);

            $product_model->stocks()->create([
                'user_id' => 1,
                'quantity' => 100,
                'stock_status' => 1,
                'unit_type' => 'kg',
                'unit_price' => $product['price'],
            ]);

            // image
            $product_model
                ->addMediaFromUrl($image)
                ->toMediaCollection('featured_image');

        }
    }
}

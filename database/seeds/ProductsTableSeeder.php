<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        $ids = \App\Category::where('id', '>', '5')->lists('id')->toArray();

        for ($i = 0; $i <= 500; $i++) {
            $images = [];
            array_push($images, $faker->imageUrl(300, 300));
            \App\Product::create([
                'user' => $faker->randomElement(\App\User::where('role', 'both')->orWhere('role', 'supplier')->lists('id')->toArray()),
                'approved' => $faker->randomElement([1, 0]),
                'name' => $faker->name,
                'category' => $faker->randomElement($ids),
                'model_number' => $faker->name,
                'group' => $faker->name,
                'specification' => $faker->sentence(),
                'brand_name' => $faker->name,
                'supply_period' => $faker->dateTimeBetween('now', '5 days'),
                'period_validity' => $faker->dateTimeBetween('now', '5 days'),
                'minimum_order_quantity' => $faker->numberBetween(1, 1000),
                'fob_price' => $faker->randomFloat(10, 5, 10),
                'supplying_ability' => $faker->word,
                'payment_type' => $faker->word,
                'product_description' => $faker->sentence(),
                'images' => json_encode($images)
            ]);
        }

    }
}

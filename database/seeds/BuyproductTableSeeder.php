<?php

use Illuminate\Database\Seeder;

class BuyproductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        for ($i = 1; $i <= 100; $i++) {
            $images = [];
            array_push($images, $faker->imageUrl(300, 300));
            \App\Buyproduct::create([
                'user' => $faker->randomElement(\App\User::where('id', '<>', 1)->lists('id')->toArray()),
                'approved' => $faker->randomElement([1, 0]),
                'product_name' => $faker->name,
                'specification' => $faker->sentence,
                'images' => json_encode($images),
                'category' => $faker->randomElement(\App\Category::where('parent', '<>', 0)->lists('id')->toArray()),
                'order_quantity' => $faker->numberBetween(100, 1000000),
                'quantity_unit' => $faker->randomElement(['set', 'piece']),
                'expire_date' => $faker->date("Y-m-d", "+7 days"),
                'company_name' => $faker->name,
                'contact_person' => $faker->name,
                'country' => $faker->country,
                'email' => $faker->email,
                'telephone' => $faker->phoneNumber,
                'mobile' => $faker->phoneNumber,
                'other_social_contact' => $faker->url,
            ]);
        }

    }
}

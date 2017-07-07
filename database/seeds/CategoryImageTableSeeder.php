<?php

use Illuminate\Database\Seeder;

class CategoryImageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        for ($i = 1; $i <= 20; $i++) {
            \App\CategoryImage::insert([
                'category_id' => $i,
                'image' => $faker->imageUrl()
            ]);
        }
    }
}

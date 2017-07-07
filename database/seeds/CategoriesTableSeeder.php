<?php

use Faker\Factory;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        $i = 1;
        $l = 1;
        for ($j = 1; $j <= 20; $j++) {

            \App\Category::create([
                'name' => $faker->name,
                'parent' => $i++,
                'level' => $l
            ]);

            (($i > 5) ? ($i = 1 and $l = 2) : $i = $i);
        }

        \App\Category::whereBetween('id', [1, 5])->update(['parent' => 0]);

    }
}

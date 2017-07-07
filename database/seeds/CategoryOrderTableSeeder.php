<?php

use Illuminate\Database\Seeder;

class CategoryOrderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        for ($i = 1; $i <= 20; $i++) {

            \App\CategoryOrder::create([

                'category_id' => $i,
                'order' => $i

            ]);
        }

    }
}

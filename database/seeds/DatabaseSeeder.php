<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    private $toTruncate = [
        'categories',
        'category_orders',
        'products',
        'category_image',
        'users',
        'buyproducts',
        'reqtobuyer',
        'reqtosupplier',
        'messages',
        'replies'
    ];


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        $this->truncate();
        $this->call(CategoriesTableSeeder::class);
        $this->call(CategoryOrderTableSeeder::class);
        $this->call(CategoryImageTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(ProductsTableSeeder::class);
        $this->call(BuyproductTableSeeder::class);
        $this->call(ReqtobuyerTableSeeder::class);
        $this->call(ReqtosupplierTableSeeder::class);
        Model::reguard();
    }

    private function truncate()
    {
        foreach ($this->toTruncate as $table) {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            DB::table($table)->truncate();
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        }
    }
}

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Products extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {

            $table->increments('id');
            $table->boolean('approved');
            $table->integer('user')->unsigned();
            $table->text('name');
            $table->integer('category')->unsigned();
            $table->text('model_number');
            $table->text('group');
            $table->text('specification');
            $table->text('brand_name');
            $table->text('supply_period');
            $table->text('period_validity');
            $table->text('minimum_order_quantity');
            $table->text('fob_price');
            $table->text('supplying_ability');
            $table->text('payment_type');
            $table->text('product_description');
            $table->text('images')->nullable();
            $table->boolean('featured');
            $table->timestamps();
            $table->foreign('user')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('products');
    }
}

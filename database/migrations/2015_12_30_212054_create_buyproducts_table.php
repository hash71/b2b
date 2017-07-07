<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBuyproductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buyproducts', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('approved');
            $table->integer('user')->unsigned();
            $table->text('product_name');
            $table->text('specification');
            $table->text('images');
            $table->integer('category')->unsigned();
            $table->float('order_quantity', 12, 2);
            $table->string('quantity_unit');
            $table->dateTime('expire_date');
            $table->text('company_name');
            $table->text('contact_person');
            $table->string('country');
            $table->string('email');
            $table->string('telephone');
            $table->string('mobile');
            $table->text('other_social_contact');
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
        Schema::drop('buyproducts');
    }
}

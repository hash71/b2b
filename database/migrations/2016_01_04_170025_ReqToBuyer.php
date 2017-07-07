<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ReqToBuyer extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reqtobuyer', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('supplier')->unsigned();
            $table->integer('buyer')->unsigned();
            $table->text('message');
            $table->text('additional');
            $table->text('supply_ability');
            $table->text('images');
            $table->boolean('approved');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('reqtobuyer');
    }
}

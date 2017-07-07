<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReqtosupplierTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reqtosupplier', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('supplier')->unsigned();
            $table->integer('buyer')->unsigned();
            $table->text('subject');
            $table->text('message');
            $table->dateTime('response_required_time');
            $table->text('additional');
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
        Schema::drop('reqtosupplier');
    }
}

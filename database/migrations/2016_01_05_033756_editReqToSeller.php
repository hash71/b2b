<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditReqToSeller extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reqtosupplier', function (Blueprint $table) {
            $table->foreign('buyer')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('supplier')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reqtosupplier', function (Blueprint $table) {
            //
        });
    }
}

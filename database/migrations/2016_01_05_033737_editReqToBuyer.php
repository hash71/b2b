<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditReqToBuyer extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reqtobuyer', function (Blueprint $table) {
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
        Schema::table('reqtobuyer', function (Blueprint $table) {
            //
        });
    }
}

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('role');
            $table->string('email')->unique();
            $table->boolean('approved');
            $table->string('password', 60);
            $table->string('type', 20);
            $table->string('company_name', '255');
            $table->integer('category')->unsigned();
            $table->string('contact_person');
            $table->string('business_phone');
            $table->boolean('subscribe')->default(0);
            $table->text('business_type');
            $table->text('main_market');
            $table->text('main_products');
            $table->text('established_year');
            $table->text('total_employee');
            $table->text('capitalization');
            $table->text('revenue');
            $table->text('capital');
            $table->text('ownership');
            $table->text('sales_volume');
            $table->text('export_percent');
            $table->text('certifications');
            $table->text('factory_location');
            $table->text('factory_size');
            $table->text('production_lines');
            $table->text('production_capacity');
            $table->text('purchase_volume');
            $table->text('rd_stuff');
            $table->text('qc_stuff');
            $table->text('quality_control');
            $table->text('contract_manufact');
            $table->text('about_us');
            $table->text('address');
            $table->text('city');
            $table->text('country');
            $table->text('state');
            $table->text('postal_code');
            $table->text('telephone');
            $table->text('fax');
            $table->text('mobile');
            $table->text('website');
            $table->boolean('paid_member');
            $table->boolean('verified_company');
            $table->boolean('gold_supplier');
            $table->boolean('premium_gold_supplier');
            $table->text('logo');
            $table->timestamp('joined_at');
            $table->timestamp('upgraded_at');
            $table->rememberToken();
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
        Schema::drop('users');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceProvidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_providers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id');
            $table->integer('sub_category_id');
            $table->string('brand_name')->nullable();
            $table->string('strap_line')->nullable();
            $table->text('description')->nullable();
            $table->text('title')->nullable();
            $table->text('message')->nullable();
            $table->string('firstname')->nullable();
            $table->string('lastname')->nullable();
            $table->string('email');
            $table->text('mobile')->nullable();
            $table->string('street')->nullable();
            $table->string('city')->nullable();
            $table->text('zipcode')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();
            $table->text('available_for_zipcodes')->nullable();
            $table->string('web_url')->nullable();
            $table->text('logo')->nullable();
            $table->text('color')->nullable();
            $table->integer('commission_rate')->nullable();
            $table->integer('discount_rate')->default(0);
            $table->text('unverified_commission_rate')->nullable();
            $table->text('whoop_credit')->nullable();
            $table->text('video')->nullable();
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
        Schema::dropIfExists('service_providers');
    }
}

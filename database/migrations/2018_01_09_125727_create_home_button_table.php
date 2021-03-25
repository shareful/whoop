<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHomeButtonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('home_button', function (Blueprint $table) {
            $table->increments('id');
            $table->string('country', 100);
            $table->string('city', 100);
            $table->string('zipcode', 9);
            $table->string('address', 255);
            $table->string('unique_code')->unique();
            // $table->unique(['country','city', 'zipcode', 'address'], 'unique_home_button');
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
        Schema::dropIfExists('home_button');        
    }
}

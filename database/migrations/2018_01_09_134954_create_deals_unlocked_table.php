<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDealsUnlockedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deals_unlocked', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('home_button_id');
            $table->integer('sub_category_id'); // sub_category_id is the deal
            $table->integer('unlocked_by');
            $table->unique(['home_button_id','sub_category_id'], 'home_button_deal_id');
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
        Schema::dropIfExists('deals_unlocked');        
    }
}

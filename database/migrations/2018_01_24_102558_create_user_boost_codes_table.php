<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use \App\Models\Admin\UserBoostCode;

class CreateUserBoostCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_boost_codes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('boost_code_id'); //This is actually the id of boost code providers
            $table->enum('status', array(UserBoostCode::STATUS_USED, UserBoostCode::STATUS_UNUSED));
            $table->dateTime('date_used');
            $table->integer('used_on_deal_id')->nullable();
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
        Schema::dropIfExists('user_boost_codes');
    }
}

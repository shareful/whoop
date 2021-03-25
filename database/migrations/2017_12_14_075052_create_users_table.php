<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use \App\Models\Admin\HomeButton;
use \App\Models\Admin\User;

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
            $table->enum('user_type', [
                User::TYPE_ADMIN,
                User::TYPE_TRIAL,
                User::TYPE_VERIFIED,
                User::TYPE_UNVERIFIED,
            ]);
            $table->text('token_id')->nullable();
            $table->string('firstname')->nullable();
            $table->string('lastname')->nullable();
            $table->string('photo')->nullable();
            $table->string('email');
            $table->text('password');
            $table->string('mobile')->nullable();
            $table->string('country', 100);
            $table->string('city', 100);
            $table->string('zipcode', 9);
            $table->string('address', 255);
            $table->tinyInteger('is_verified')->nullable();
            $table->integer('home_button_id')->unsigned()->nullable();
            $table->enum('home_button_status', [
                HomeButton::STATUS_LOCKED,
                HomeButton::STATUS_UNLOCKED
            ])->nullable();
            $table->tinyInteger('email_verified')->nullable();
            $table->string('api_token', 60)->unique()->nullable();
            $table->string('email_token')->unique()->nullable();
            $table->timestamp('trial_start_date')->nullable();
            $table->timestamp('trial_end_date')->nullable();
            $table->timestamp('last_verify_date')->nullable();
            $table->rememberToken();
            $table->timestamps();

            //Foreign Keys
//            $table->foreign('home_button_id')->references('id')->on('home_button');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}

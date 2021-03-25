<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use \App\Http\Controllers\Admin\Message\MessageController;

class CreateWelcomeMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('welcome_messages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('icon', 255);
            $table->string('title', 255);
            $table->string('sub_title', 255);
            $table->text('message');
            $table->integer('position');
            $table->enum('status', array(MessageController::STATUS_ACTIVE, MessageController::STATUS_DISABLED));
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
        Schema::dropIfExists('welcome_messages');
    }
}

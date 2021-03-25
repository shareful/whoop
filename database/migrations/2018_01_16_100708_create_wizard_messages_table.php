<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use \App\Http\Controllers\Admin\Message\MessageController;

class CreateWizardMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wizard_messages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('position');
            $table->string('icon', 255);
            $table->string('title', 255);
            $table->string('message', 1000);
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
        Schema::dropIfExists('wizard_messages');
    }
}

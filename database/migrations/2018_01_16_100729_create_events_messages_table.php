<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use \App\Models\Admin\Messages\EventMessage;

class CreateEventsMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events_messages', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('target_type', EventMessage::ALLOWED_TARGETS);
            $table->integer('target_id')->unsigned();
            $table->enum('event_type', EventMessage::ALLOWED_EVENTS);
            $table->text('event_data');
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
        Schema::dropIfExists('events_messages');
    }
}

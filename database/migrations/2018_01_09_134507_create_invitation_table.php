<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use \App\Models\Admin\Invitation;

class CreateInvitationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invitation', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('home_button_id');
            $table->integer('invited_by')->unsigned();
            $table->string('to_email', 100);
            $table->enum('status', [
                Invitation::STATUS_PENDING,
                Invitation::STATUS_ACCEPTED
            ]);
            $table->integer('accepted_by')->unsigned();
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
        Schema::dropIfExists('invitation');
    }
}

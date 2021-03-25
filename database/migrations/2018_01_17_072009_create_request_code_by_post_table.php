<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use \App\Models\Admin\RequestCodeByPost;

class CreateRequestCodeByPostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_code_by_posts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->enum('posting_status', [
                RequestCodeByPost::POSTING_STATUS_PENDING,
                RequestCodeByPost::POSTING_STATUS_POSTED
            ]);
            $table->enum('user_action_status', [
                RequestCodeByPost::USER_ACTION_PENDING,
                RequestCodeByPost::USER_ACTION_SUCCESS
            ]);
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
        Schema::dropIfExists('request_code_by_posts');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use \App\Models\Admin\Appointment;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('service_provider_id');
            $table->date('appointment_date');
            $table->text('job_info')->nullable();
            $table->enum('slot', array(Appointment::SLOT_MORNING, Appointment::SLOT_AFTERNOON, Appointment::SLOT_EVENING ));
            $table->enum('status', array(Appointment::STATUS_NEW, Appointment::STATUS_BOOKED, Appointment::STATUS_COMPLETED ));
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
        Schema::dropIfExists('appointments');
    }
}

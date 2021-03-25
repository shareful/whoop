<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Models\Admin\Appointment;

class AppointmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('appointments')->insert([
            'user_id'  => 2,
			'service_provider_id'  => 1,
			'appointment_date' => Carbon::now(),
			'job_info' => 'Example job info details',
			'slot' => Appointment::SLOT_MORNING,
			'status' => Appointment::STATUS_NEW,
			'created_at' => Carbon::now(),
			'updated_at' => Carbon::now()
        ]);
    }
}

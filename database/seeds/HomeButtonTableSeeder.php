<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class HomeButtonTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('home_button')->insert([
            'country'  => 'United Kingdom',
            'city'  => 'Swindon',
            'zipcode'  => 'SN38 1NW',
            'address'  => 'NATIONWIDE BLDG SOC',
            'unique_code'  => strtoupper(str_random(8)),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}

<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Models\Admin\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create admin user
        DB::table('users')->insert([
            'user_type' => User::TYPE_ADMIN,
            'email' => 'admin@test.com',
            'password' => Hash::make('admin'),
            'token_id' => '123456',
            'firstname' => 'Nikunj',
            'lastname' => 'Goriya',
            'mobile' => '9876543210',
            'country' => 'United KIngdom',
            'city' => 'XYZ',
            'address' => 'XYZ',
            'zipcode' => '123456',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        // Create a verified app user
        DB::table('users')->insert([
            'user_type' => User::TYPE_VERIFIED,
            'email' => 'appuser@example.com',
            'password' => Hash::make('123456'),
            'token_id' => '1234567',
            'firstname' => 'App',
            'lastname' => 'User',
            'mobile' => '8876543210',
            'address' => 'NATIONWIDE BLDG SOC',
            'zipcode' => 'SN38 1NW',
            'country' => 'United Kingdom',
            'city' => 'Swindon',
            'is_verified' => 1,
            'home_button_id' => 1,
            'home_button_status' => 'unlocked',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        // Create an unverified app user
        DB::table('users')->insert([
            'user_type' => User::TYPE_TRIAL,
            'email' => 'appuser2@example.com',
            'password' => Hash::make('123456'),
            'token_id' => '1234567',
            'firstname' => 'App',
            'lastname' => 'User2',
            'mobile' => '8876543210',
            'address' => 'NATIONWIDE BLDG SOC',
            'zipcode' => 'SN38 1NW',
            'country' => 'United Kingdom',
            'city' => 'Swindon',
            'is_verified' => 0,
            'home_button_id' => 1,
            'home_button_status' => 'locked',
            'trial_start_date' => Carbon::now(),
            'trial_end_date' => Carbon::now()->addDays(30),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}

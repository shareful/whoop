<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class UserUsedDealTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_used_deal')->insert([
            'user_id' => 2,
            'deal_id' => 1,
            'service_provider_id' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}

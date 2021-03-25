<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class DealsUnlockedTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('deals_unlocked')->insert([
			'home_button_id'  => 1,
			'sub_category_id'  => 1,
			'unlocked_by'  => 2,
			'created_at' => Carbon::now(),
			'updated_at' => Carbon::now()
        ]);
    }
}

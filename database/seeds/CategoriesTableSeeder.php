<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      	DB::table('categories')->insert([
			'name'  => 'Tradepeople',
			'image' => '',
            'description' => 'Tradespeople category description goes here',
			'is_national' => 1,
			'created_at' => Carbon::now(),
			'updated_at' => Carbon::now()
        ]);

        DB::table('categories')->insert([
			'name'  => 'Insurance',
			'image' => '',
            'description' => 'Insurance category description goes here',
			'is_national' => 1,
			'created_at' => Carbon::now(),
			'updated_at' => Carbon::now()
        ]);
    }
}

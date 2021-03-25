<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class SubcategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sub_categories')->insert([
			'category_id'  => 1,
			'name' => 'Plumber',
			'image' => '',
            'description' => 'Plumber deal description goes here',
			'end_date' => Carbon::now()->addDays(30),
			'created_at' => Carbon::now(),
			'updated_at' => Carbon::now()
        ]);

        DB::table('sub_categories')->insert([
			'category_id'  => 1,
			'name' => 'Carpenter',
			'image' => '',
            'description' => 'Carpenter deal description goes here',
			'end_date' => Carbon::now()->addDays(30),
			'created_at' => Carbon::now(),
			'updated_at' => Carbon::now()
        ]);
    }
}

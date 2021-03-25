<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ProviderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('service_providers')->insert([
            'category_id'  => 1,
			'sub_category_id'  => 1,
			'brand_name' => 'Example brand 1',
			'strap_line' => 'Example strap line 1',
			'description' => 'Example brand description',
			'firstname' => 'First',
			'lastname' => 'Plumber',
			'email' => 'frist.plumbar@example.com',
			'mobile' => '01716513782',
			'street' => 'example street',
			'city' => 'Swindon',
			'zipcode' => 'SN38 1NW',
			'state' => '',
			'country' => 'United Kingdom',
			'available_for_zipcodes' => 'SN38 1NW',
			'web_url' => 'http://www.example-brand-weburl.com',
            'logo' => '',
            'color' => '#efefef',
            'commission_rate' => '5',
            'discount_rate' => '2',
            'whoop_credit' => '5',
            'video' => '',
			'created_at' => Carbon::now(),
			'updated_at' => Carbon::now()
        ]);

        DB::table('service_providers')->insert([
            'category_id'  => 1,
			'sub_category_id'  => 1,
			'brand_name' => 'Example brand 2',
			'strap_line' => 'Example strap line 2',
			'description' => 'Example brand description',
			'firstname' => 'Second',
			'lastname' => 'Plumber',
			'email' => 'second.plumbar@example.com',
			'mobile' => '01516513782',
			'street' => 'example street',
			'city' => 'Swindon',
			'zipcode' => 'SN38 1NW',
			'state' => '',
			'country' => 'United Kingdom',
			'available_for_zipcodes' => 'SN38 1NW',
			'web_url' => 'http://www.example-brand-weburl.com',
            'logo' => '',
            'color' => '#efefef',
            'commission_rate' => '5',
            'discount_rate' => '2',
            'whoop_credit' => '5',
            'video' => '',
			'created_at' => Carbon::now(),
			'updated_at' => Carbon::now()
        ]);
    }
}

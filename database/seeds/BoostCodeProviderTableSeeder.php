<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Models\Admin\BoostCodeProvider;

class BoostCodeProviderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Someones Whoop button insertion
        DB::table('boost_code_providers')->insert([
            'unique_id' => strtoupper(str_random(8)),
            'name' => 'Example School 1',
            'description' => 'Example School details',
            'address' => 'example street',
            'boost_code' => strtoupper(str_random(8)),
            'image' => '',
            'city' => 'Swindon',
            'zipcode' => 'SN38 1NW',
            'country' => 'United Kingdom',
            'is_city' => 0,
            'credits_total' => 1000,
            'commission_rate' => 5,
            'status' => BoostCodeProvider::STATUS_ACTIVE,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('boost_code_providers')->insert([
            'unique_id' => strtoupper(str_random(8)),
			'name' => 'Example School 2',
			'description' => 'Example School details',
			'address' => 'example street',
            'boost_code' => strtoupper(str_random(8)),
			'image' => '',
			'city' => 'Swindon',
			'zipcode' => 'SN38 1NW',
			'country' => 'United Kingdom',
			'is_city' => 0,
			'credits_total' => 1000,
            'commission_rate' => 10,
            'status' => BoostCodeProvider::STATUS_ACTIVE,
            'created_at' => Carbon::now(),
			'updated_at' => Carbon::now()
        ]);

        // City Butons insertions
        DB::table('boost_code_providers')->insert([
            // 'unique_id' => strtoupper(str_random(8)),
            'name' => 'Manchester',
            'description' => 'Manchester boost code details',
            // 'address' => 'example street',
            'boost_code' => strtoupper(str_random(8)),
            'image' => '',
            'city' => 'Manchester',
            // 'zipcode' => 'SN38 1NW',
            'country' => 'United Kingdom',
            'is_city' => 1,
            'credits_total' => 1000,
            'commission_rate' => 5,
            'status' => BoostCodeProvider::STATUS_ACTIVE,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('boost_code_providers')->insert([
            // 'unique_id' => strtoupper(str_random(8)),
			'name' => 'London',
			'description' => 'London boost code details',
			// 'address' => 'example street',
            'boost_code' => strtoupper(str_random(8)),
			'image' => '',
			'city' => 'London',
			// 'zipcode' => 'SN38 1NW',
			'country' => 'United Kingdom',
			'is_city' => 1,
			'credits_total' => 1000,
            'commission_rate' => 5,
            'status' => BoostCodeProvider::STATUS_ACTIVE,
            'created_at' => Carbon::now(),
			'updated_at' => Carbon::now()
        ]);
    }
}

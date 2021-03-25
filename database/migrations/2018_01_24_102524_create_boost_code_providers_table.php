<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use \App\Models\Admin\BoostCodeProvider;

class CreateBoostCodeProvidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('boost_code_providers', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('is_city'); // set 1 if it is a city boost codes
            $table->string('name')->unique(); // Set city name here for city boot codes
            $table->string('unique_id')->unique()->nullable(); // generate unique id for non city boost codes, null for city boost codes
            $table->string('boost_code', 8)->unique(); // generate a unique boost code 8 chars long
            $table->string('description')->nullable();
            $table->string('address')->nullable(); // null for city and can have address lines for schools or others
            $table->string('image')->nullable();
            $table->string('country');
            $table->string('city'); // for city boost code this field will contain city name also
            $table->string('zipcode')->nullable(); // for city boost code this field would be null
            $table->integer('credits_total'); // credits per month
            $table->integer('commission_rate'); // commission percent rate will apply
            $table->enum('status', array(BoostCodeProvider::STATUS_ACTIVE, BoostCodeProvider::STATUS_DISABLED));
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
        Schema::dropIfExists('boost_code_providers');
    }
}

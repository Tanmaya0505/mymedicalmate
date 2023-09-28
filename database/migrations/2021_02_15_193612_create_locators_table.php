<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocatorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locators', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('customer_id')->unsigned()->nullable();
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->tinyInteger('device_type')->default('1')->comment = '1=Web,2=Android,3=Ios';
            $table->string('ip_address', 70)->nullable();
            $table->string('city', 70)->nullable();
            $table->string('country', 70)->nullable();
            $table->string('country_code', 70)->nullable();
            $table->string('region', 70)->nullable();
            $table->json('geo_location_info')->nullable();
            $table->json('device_browser_info')->nullable();
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
        Schema::dropIfExists('locators');
    }
}

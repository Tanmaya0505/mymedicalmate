<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerPrescriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_prescriptions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('customer_id')->unsigned()->nullable();
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->string('prescription_photo', 70)->nullable();
            $table->json('medicine')->nullable();
            $table->string('full_name', 70)->nullable();
            $table->string('mobile_no', 70)->nullable();
            $table->string('gender', 70)->nullable();
            $table->string('age', 70)->nullable();
            $table->tinyInteger('ship_type')->default('1')->comment = '1=Courier,2=Transportation';
            $table->json('delivery_address')->nullable();
            $table->text('note')->nullable();
            $table->tinyInteger('customer_status')->default('1')->comment = '1-Uploaded, 2-Assigned To Vendor, 3-Pending From Customer, 4-Confirmed, 5-Dispatched, 6-Delivered, 7-Return, 8-Returned, 0-Cancelled';
            $table->text('order_id')->nullable();
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
        Schema::dropIfExists('customer_prescriptions');
    }
}

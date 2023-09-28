<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorPrescriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendor_prescriptions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('vendor_id')->unsigned()->nullable();
            $table->foreign('vendor_id')->references('id')->on('customers');
            $table->integer('prescription_id')->unsigned()->nullable();
            $table->foreign('prescription_id')->references('id')->on('customer_prescriptions');
            $table->json('medicine')->nullable();
            $table->tinyInteger('status')->default('0')->comment = '0-Assign, 1-Approved, 2-Cancelled';
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
        Schema::dropIfExists('vendor_prescriptions');
    }
}

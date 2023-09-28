<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingCommisionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_commisions', function (Blueprint $table) {
            $table->increments('id',20);
            $table->bigInteger('booking_id',20);
            $table->bigInteger('vendor_id',20)->nullable();
            $table->bigInteger('mademate_id',20)->nullable();
            $table->bigInteger('admin_id',20)->nullable();
            $table->string('total_amt',255)->nullable();
            $table->string('vendor_amt',255)->nullable();
            $table->string('mademate_amt',255)->nullable();
            $table->string('admin_amt',255)->nullable();
            $table->string('vendor_prcnt',255)->nullable();
            $table->string('mademate_prcnt',255)->nullable();
            $table->string('admin_prcnt',255)->nullable();
            $table->enum('status',['paid','unpaid'])->default('unpaid');
            $table->string('admin_status',255);
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
        Schema::dropIfExists('booking_commisions');
    }
}

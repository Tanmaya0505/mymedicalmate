<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssistantBoyBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assistant_boy_bookings', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id')->unsigned()->nullable();
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->integer('assistant_boy_id')->unsigned()->nullable();
            $table->foreign('assistant_boy_id')->references('id')->on('customers');
            $table->json('assistant_boy_meta')->nullable()->comment = "Profile details";
            $table->json('customer_meta')->nullable()->comment = "Profile details";
            $table->string('book_date')->nullable();
            $table->string('arrival_time')->nullable();
            $table->tinyInteger('pickup_status')->default('0')->comment = '0=No, 1=yes';
            $table->string('arrival_km', 70)->nullable();
            $table->tinyInteger('early_serial_status')->default('0')->comment = '0=No, 1=yes';
            $table->string('early_serial', 70)->nullable();
            $table->tinyInteger('fooding_status')->default('0')->comment = '0=No, 1=yes';
            $table->tinyInteger('booking_criteria')->default('1')->comment = '1-Day Booking, 2-Night Booking, 3- Day and night';
            $table->tinyInteger('currency')->default('1')->comment = '1=INR,2=Dollar';
            $table->tinyInteger('coupon_status')->default('0')->comment = '0=Non,1=Applied';
            $table->decimal('total_price', 8, 2)->nullable();
            $table->decimal('pickup_price', 8, 2)->nullable();
            $table->decimal('discount_price', 8, 2)->nullable();
            $table->decimal('grand_price', 8, 2)->nullable();
            $table->tinyInteger('booking_status')->default('1')->comment = '0=Failed,1=Booked,2=Accepted,3=OnBusy,4=Cancelled,5=Completed';
            $table->tinyInteger('fwrd_status')->default('0')->comment = '0=Not Forwarded,1=Forwarded';
            $table->tinyInteger('payment_mode')->default('2')->comment = '1=Online,2=Pay After service';
            $table->tinyInteger('payment_receive_status')->default('0')->comment = '0=Not-received,1=Received';
            $table->tinyInteger('customer_review_status')->default('0')->comment = '0=Not-Viewed,1=Viewed';
            $table->tinyInteger('assistant_review_status')->default('0')->comment = '0=Not-Viewed,1=Viewed';
            $table->text('booking_id')->nullable();
            $table->string('transaction_id', 255)->nullable();
            $table->tinyInteger('cronjob_status')->default('0')->comment = '0=Not-sent,1=Sent';
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
        Schema::dropIfExists('assistant_boy_bookings');
    }
}

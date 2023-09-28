<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssistantCancelBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assistant_cancel_bookings', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('booking_id')->unsigned()->nullable();
            $table->foreign('booking_id')->references('id')->on('assistant_boy_bookings');
            $table->tinyInteger('from_canceled')->default('1')->comment = '1=Admin, 2=User';
            $table->text('cancel_reason')->nullable();
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
        Schema::dropIfExists('assistant_cancel_bookings');
    }
}

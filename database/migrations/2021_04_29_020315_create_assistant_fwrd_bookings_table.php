<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssistantFwrdBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assistant_fwrd_bookings', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('booking_id')->unsigned()->nullable();
            $table->foreign('booking_id')->references('id')->on('assistant_boy_bookings');
            $table->integer('assistant_boy_fwrd_from_id')->unsigned()->nullable();
            $table->foreign('assistant_boy_fwrd_from_id')->references('id')->on('customers');
            $table->json('assistant_boy_fwrd_from_meta')->nullable()->comment;
            $table->text('assistant_boy_fwrd_comment')->nullable();
            $table->integer('assistant_boy_fwrd_to_id')->unsigned()->nullable();
            $table->foreign('assistant_boy_fwrd_to_id')->references('id')->on('customers');
            $table->json('assistant_boy_fwrd_to_meta')->nullable()->comment;
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
        Schema::dropIfExists('assistant_fwrd_bookings');
    }
}

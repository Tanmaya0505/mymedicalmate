<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssistantReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assistant_reviews', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('booking_id')->unsigned()->nullable();
            $table->foreign('booking_id')->references('id')->on('assistant_boy_bookings');
            $table->integer('rating')->nullable();
            $table->text('review')->nullable();
            $table->string('photo', 255)->nullable();
            $table->tinyInteger('status')->default(0)->comment = '0=Pending,1=Verified';
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
        Schema::dropIfExists('assistant_reviews');
    }
}

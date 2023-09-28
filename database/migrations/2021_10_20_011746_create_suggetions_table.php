<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuggetionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suggetions', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id')->unsigned()->nullable();
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->string('sugg_name', 70)->nullable();
            $table->string('sugg_phone', 70)->nullable();
            $table->string('sugg_email', 70)->nullable();
            $table->string('sugg_complaint_type', 70)->nullable();
            $table->integer('sugg_state')->nullable();
            $table->integer('sugg_district')->nullable();
            $table->text('sugg_message')->nullable();
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
        Schema::dropIfExists('suggetions');
    }
}

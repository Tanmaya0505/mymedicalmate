<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlltypeAdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alltype_ads', function (Blueprint $table) {
            $table->id();
            $table->string('type_user', 70)->nullable();
            $table->string('file_path', 70)->nullable();
            $table->string('file_type', 70)->nullable();
            $table->bigInteger('staff_id')->nullable();
            $table->tinyInteger('status')->default('0')->comment = '0=Inactive,1=Active,2=Blocked by admin';
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
        Schema::dropIfExists('alltype_ads');
    }
}

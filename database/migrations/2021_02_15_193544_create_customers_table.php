<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('account_id')->unsigned()->nullable();
            $table->foreign('account_id')->references('id')->on('account_types');
            $table->string('first_name', 70)->nullable();
            $table->string('last_name', 70)->nullable();
            $table->string('email', 70)->nullable();
            $table->string('phone', 70)->nullable();
            $table->string('password', 70)->nullable();
            $table->dateTime('email_verified_at')->nullable();
            $table->json('meta')->nullable()->comment = "Profile image";
            $table->tinyInteger('status')->default('0')->comment = '0=Only signup,1=Verified customer,2=Blocked by admin';
            $table->string('restricted_reason', 255)->nullable();
            $table->tinyInteger('online_status')->default('1')->comment = '1=Online,0=Offline';
            $table->tinyInteger('admin_status')->default('0')->comment = '0=Pending,1=Verified';
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
        Schema::dropIfExists('customers');
    }
}

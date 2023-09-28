<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendor_invoices', function (Blueprint $table) {
            $table->increments('id',11);
            $table->string('medicine_name', 225)->nullable();
            $table->string('quantity', 225)->nullable();
            $table->string('price', 225)->nullable();
            $table->string('total_price', 225)->nullable();
            $table->string('discount', 225)->nullable();
            $table->bigInteger('vendor_id')->nullable();
            $table->bigInteger('order_id')->nullable();
            $table->tinyInteger('status')->default('0')->comment = '0=apply,1=Confirm,2=Cancelled by user';
            $table->integer('created_by',11)->nullable();
            $table->integer('is_approved_by_vendor',11)->nullable();
            $table->timestamps();
            $table->integer('is_deleted',11);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vendor_invoices');
    }
}

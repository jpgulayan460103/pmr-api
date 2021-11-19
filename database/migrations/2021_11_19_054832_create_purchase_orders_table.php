<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('purchase_request_id')->nullable();
            $table->string('purchase_order_number_uuid')->nullable();
            $table->string("purchase_order_number")->nullable();
            $table->string("purchase_order_dir")->nullable();
            $table->string("name_of_supplier")->nullable();
            $table->string("iar_dir")->nullable();
            $table->string("receipt_dir")->nullable();
            $table->string("receipt_number")->nullable();
            $table->string("type_of_equipment")->nullable();
            $table->string("attendance")->nullable();
            $table->string("certificate_of_acceptance")->nullable();
            $table->string("certificate_of_occupancy")->nullable();
            $table->string("certificate_of_completion")->nullable();
            $table->timestamps();
            $table->foreign('purchase_request_id')->references('id')->on('purchase_requests');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchase_orders');
    }
}

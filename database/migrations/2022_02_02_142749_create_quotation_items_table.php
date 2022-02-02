<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuotationItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotation_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('quotation_id')->nullable();
            $table->unsignedBigInteger('purchase_request_item_id')->nullable();
            $table->longText('suppliers_specifications')->nullable();
            $table->integer('quantity')->nullable();
            $table->float('unit_cost',15,2);
            $table->float('total_unit_cost',15,2);
            $table->timestamps();
            $table->foreign('quotation_id')->references('id')->on('quotations')->onDelete('cascade');
            $table->foreign('purchase_request_item_id')->references('id')->on('purchase_request_items')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quotation_items');
    }
}

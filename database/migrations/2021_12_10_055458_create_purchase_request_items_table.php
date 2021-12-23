<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseRequestItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_request_items', function (Blueprint $table) {
            $table->id();
            $table->string('item_name')->nullable();
            $table->string('item_code')->nullable();
            $table->integer('quantity');
            $table->float('unit_cost',8,2);
            $table->float('total_unit_cost',8,2);
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
        Schema::dropIfExists('purchase_request_items');
    }
}

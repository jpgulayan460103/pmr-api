<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPurchaseItemsReferences extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('purchase_request_items', function (Blueprint $table) {
            $table->unsignedBigInteger('item_id')->nullable();
            $table->unsignedBigInteger('purchase_request_item_detail_id')->nullable();
            $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade');
            $table->foreign('purchase_request_item_detail_id')->references('id')->on('purchase_request_item_details')->onDelete('cascade');
        });
        Schema::table('purchase_request_item_details', function (Blueprint $table) {
            $table->unsignedBigInteger('purchase_request_item_id')->nullable();
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
        Schema::table('purchase_request_item_details', function (Blueprint $table) {
            $table->dropForeign(['purchase_request_item_id']);
            $table->dropColumn('purchase_request_item_id');
        });
        Schema::table('purchase_request_items', function (Blueprint $table) {
            $table->dropForeign(['purchase_request_item_detail_id']);
            $table->dropColumn('purchase_request_item_detail_id');
            $table->dropForeign(['item_id']);
            $table->dropColumn('item_id');
        });
    }
}

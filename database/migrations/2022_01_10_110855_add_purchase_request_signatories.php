<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPurchaseRequestSignatories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('purchase_requests', function (Blueprint $table) {
            $table->unsignedBigInteger('requested_by_id')->nullable();
            $table->unsignedBigInteger('approved_by_id')->nullable();
            $table->foreign('requested_by_id')->references('id')->on('libraries')->onDelete('cascade');
            $table->foreign('approved_by_id')->references('id')->on('libraries')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('purchase_requests', function (Blueprint $table) {
            $table->dropForeign(['requested_by_id']);
            $table->dropForeign(['approved_by_id']);
            $table->dropColumn('requested_by_id');
            $table->dropColumn('approved_by_id');
        });
    }
}

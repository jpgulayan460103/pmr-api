<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBacPurchaseRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bac_purchase_requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('purchase_request_id')->nullable();
            $table->string('bac_purchase_request_uuid')->nullable();
            $table->string("preproc_conference")->nullable();
            $table->string("post_of_ib")->nullable();
            $table->string("prebid_conf")->nullable();
            $table->string("eligibility_check")->nullable();
            $table->string("open_of_bids")->nullable();
            $table->string("bid_evaluation")->nullable();
            $table->string("post_qual")->nullable();
            $table->string("notice_of_award")->nullable();
            $table->string("contract_signing")->nullable();
            $table->string("notice_to_proceed")->nullable();
            $table->string("estimated_ldd")->nullable();
            $table->string("abstract_of_qoutations")->nullable();
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
        Schema::dropIfExists('bac_purchase_requests');
    }
}

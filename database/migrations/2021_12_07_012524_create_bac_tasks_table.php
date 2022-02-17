<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBacTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bac_tasks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('purchase_request_id')->nullable();
            $table->string('bac_task_uuid')->nullable();
            $table->string("preproc_conference")->nullable();
            $table->string("post_of_ib")->nullable();
            $table->string("prebid_conf")->nullable();
            $table->string("eligibility_check")->nullable();
            $table->string("open_of_bids")->nullable();
            $table->string("bid_evaluation")->nullable();
            $table->string("post_qual")->nullable();
            $table->date("notice_of_award")->nullable();
            $table->date("contract_signing")->nullable();
            $table->date("notice_to_proceed")->nullable();
            $table->string("estimated_ldd")->nullable();
            $table->string("abstract_of_qoutations")->nullable();
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
        Schema::dropIfExists('bac_tasks');
    }
}

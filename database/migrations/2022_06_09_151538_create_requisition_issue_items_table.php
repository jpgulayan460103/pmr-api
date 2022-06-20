<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequisitionIssueItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requisition_issue_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('requisition_issue_id')->nullable();
            $table->unsignedBigInteger('item_id')->nullable();
            $table->unsignedBigInteger('procurement_plan_item_id')->nullable();
            $table->unsignedBigInteger('unit_of_measure_id')->nullable();
            $table->integer('request_quantity')->nullable();
            $table->integer('issue_quantity')->nullable();
            $table->boolean('has_stock')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('requisition_issue_items');
    }
}

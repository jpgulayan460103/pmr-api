<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_requests', function (Blueprint $table) {
            $table->id();
            $table->string('purchase_request_uuid')->nullable();
            $table->string('purchase_request_number')->nullable();
            $table->string('purpose')->nullable();
            $table->string('pr_dir')->nullable();
            $table->float('total_cost',15,2)->nullable();
            $table->date('pr_date')->nullable();
            $table->unsignedBigInteger('end_user_id')->nullable();
            $table->unsignedBigInteger('purchase_request_type_id')->nullable();
            $table->unsignedBigInteger('mode_of_procurement_id')->nullable();
            $table->string('uacs_code')->nullable();
            $table->string('fund_cluster')->nullable();
            $table->string('center_code')->nullable();
            $table->string('charge_to')->nullable();
            $table->float('alloted_amount',15,2)->nullable();
            $table->string('sa_or')->nullable();
            $table->string('status')->nullable();
            $table->boolean('process_complete_status')->nullable();
            $table->date('process_complete_date')->nullable();
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
        Schema::dropIfExists('purchase_requests');
    }
}

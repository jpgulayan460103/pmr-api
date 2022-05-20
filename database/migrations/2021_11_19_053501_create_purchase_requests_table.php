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
            $table->string('uuid')->nullable();
            $table->string('purchase_request_number')->nullable();
            $table->text('purpose')->nullable();
            $table->string('pr_dir')->nullable();
            $table->text('title')->nullable();
            $table->float('total_cost',15,2)->nullable();
            $table->date('pr_date')->nullable();
            $table->unsignedBigInteger('end_user_id')->nullable();
            $table->unsignedBigInteger('account_id')->nullable();
            $table->unsignedBigInteger('mode_of_procurement_id')->nullable();
            $table->unsignedBigInteger('bac_task_id')->nullable();
            $table->unsignedBigInteger('uacs_code_id')->nullable();
            $table->string('fund_cluster')->nullable();
            $table->string('center_code')->nullable();
            $table->string('charge_to')->nullable();
            $table->float('alloted_amount',15,2)->nullable();
            $table->string('sa_or')->nullable();
            $table->string('status')->nullable();
            $table->string('remarks')->nullable();
            $table->unsignedBigInteger('requested_by_id')->nullable();
            $table->unsignedBigInteger('approved_by_id')->nullable();
            $table->unsignedBigInteger('created_by_id')->nullable();
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
        Schema::dropIfExists('purchase_requests');
    }
}

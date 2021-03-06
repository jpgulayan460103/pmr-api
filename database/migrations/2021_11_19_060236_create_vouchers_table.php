<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVouchersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vouchers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('purchase_request_id')->nullable();
            $table->unsignedBigInteger('purchase_order_id')->nullable();
            $table->string("voucher_uuid")->nullable();
            $table->string("voucher_number")->nullable();
            $table->string("status")->nullable();
            $table->string("obr_by_budget_dir")->nullable();
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
        Schema::dropIfExists('vouchers');
    }
}

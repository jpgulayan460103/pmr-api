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
            $table->string('code_uacs')->nullable();
            $table->string('pr_number')->nullable();
            $table->string('particulars')->nullable();
            $table->string('pr_dir')->nullable();
            $table->string('end_user')->nullable();
            $table->string('types')->nullable();
            $table->string('mode_of_procurement')->nullable();
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

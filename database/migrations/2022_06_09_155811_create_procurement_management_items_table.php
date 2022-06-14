<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProcurementManagementItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('procurement_management_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('procurement_management_id')->nullable();
            $table->unsignedBigInteger('item_id')->nullable();
            $table->integer('mon1')->nullable();
            $table->integer('mon2')->nullable();
            $table->integer('mon3')->nullable();
            $table->integer('mon4')->nullable();
            $table->integer('mon5')->nullable();
            $table->integer('mon6')->nullable();
            $table->integer('mon7')->nullable();
            $table->integer('mon8')->nullable();
            $table->integer('mon9')->nullable();
            $table->integer('mon10')->nullable();
            $table->integer('mon11')->nullable();
            $table->integer('mon12')->nullable();
            $table->float('price',15,2)->nullable();
            $table->integer('total_quantity')->nullable();
            $table->float('total_price',15,2)->nullable();
            $table->string('form_type')->nullable();
            $table->unsignedBigInteger('form_sourceable_id')->nullable();
            $table->string('form_sourceable_type')->nullable();
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
        Schema::dropIfExists('procurement_management_items');
    }
}

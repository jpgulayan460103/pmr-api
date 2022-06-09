<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemStockHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_stock_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('item_id')->nullable();
            $table->integer('movement_quantity')->nullable();
            $table->integer('remaining_quantity')->nullable();
            $table->string('movement_type')->nullable();
            $table->string('form_source')->nullable();
            $table->unsignedBigInteger('form_sourceable_id')->nullable();
            $table->string('form_sourceable_type')->nullable();
            $table->text('remarks')->nullable();
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
        Schema::dropIfExists('item_stock_histories');
    }
}

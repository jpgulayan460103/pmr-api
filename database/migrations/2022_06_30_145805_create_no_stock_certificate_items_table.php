<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNoStockCertificateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('no_stock_certificate_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('no_stock_certificate_id')->nullable();
            $table->text('description')->nullable();
            $table->string('unit_of_measure')->nullable();
            $table->integer('quantity')->nullable();
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
        Schema::dropIfExists('no_stock_certificate_items');
    }
}

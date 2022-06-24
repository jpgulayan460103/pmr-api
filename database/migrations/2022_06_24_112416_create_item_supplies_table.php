<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemSuppliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_supplies', function (Blueprint $table) {
            $table->id();
            $table->string('item_name')->nullable();
            $table->unsignedBigInteger('item_category_id')->nullable();
            $table->unsignedBigInteger('unit_of_measure_id')->nullable();
            $table->string('uuid')->nullable();
            $table->boolean('is_active')->nullable();
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
        Schema::dropIfExists('item_supplies');
    }
}

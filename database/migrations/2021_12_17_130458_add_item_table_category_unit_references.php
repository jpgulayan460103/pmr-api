<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddItemTableCategoryUnitReferences extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('items', function (Blueprint $table) {
            $table->unsignedBigInteger('item_category_id')->nullable();
            $table->unsignedBigInteger('unit_of_measure_id')->nullable();
            $table->foreign('item_category_id')->references('id')->on('libraries')->onDelete('set null');
            $table->foreign('unit_of_measure_id')->references('id')->on('libraries')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('items', function (Blueprint $table) {
            $table->dropForeign(['item_category_id']);
            $table->dropForeign(['unit_of_measure_id']);
            $table->dropColumn('item_category_id');
            $table->dropColumn('unit_of_measure_id');
        });
    }
}

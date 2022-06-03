<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProcurementPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('procurement_plans', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->nullable();
            $table->string('title')->nullable();
            $table->string('purpose')->nullable();
            $table->string('procurement_plan_type')->nullable();
            $table->unsignedBigInteger('item_type_id')->nullable();
            $table->date('ppmp_date')->nullable();
            $table->string('calendar_year')->nullable();
            $table->string('ppmp_number')->nullable();
            $table->string('status')->nullable();
            $table->string('remarks')->nullable();
            $table->float('total_price',15,2)->nullable();
            $table->float('inflation',15,2)->nullable();
            $table->float('contingency',15,2)->nullable();
            $table->float('total_estimated_budget',15,2)->nullable();
            $table->boolean('is_supplemental')->nullable();
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->unsignedBigInteger('end_user_id')->nullable();
            $table->string('prepared_by_name')->nullable();
            $table->string('prepared_by_position')->nullable();
            $table->string('certified_by_name')->nullable();
            $table->string('certified_by_position')->nullable();
            $table->string('approved_by_name')->nullable();
            $table->string('approved_by_position')->nullable();
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
        Schema::dropIfExists('procurement_plans');
    }
}

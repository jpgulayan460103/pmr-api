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
            $table->string('title')->nullable();
            $table->string('purpose')->nullable();
            $table->unsignedBigInteger('procurement_plan_type_id')->nullable();
            $table->date('ppmp_date')->nullable();
            $table->string('calendar_year')->nullable();
            $table->string('ppmp_number')->nullable();
            $table->string('status')->nullable();
            $table->string('remarks')->nullable();
            $table->float('total_price_a',15,2)->nullable();
            $table->float('inflation_a',15,2)->nullable();
            $table->float('contingency_a',15,2)->nullable();
            $table->float('total_estimated_budget_a',15,2)->nullable();
            $table->float('total_price_b',15,2)->nullable();
            $table->float('inflation_b',15,2)->nullable();
            $table->float('contingency_b',15,2)->nullable();
            $table->float('total_estimated_budget_b',15,2)->nullable();
            $table->float('total_estimated_budget',15,2)->nullable();
            $table->boolean('is_supplemental')->nullable();
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->unsignedBigInteger('end_user_id')->nullable();
            $table->string('prepared_by_name')->nullable();
            $table->string('prepared_by_designation')->nullable();
            $table->unsignedBigInteger('certified_by_id')->nullable();
            $table->string('certified_by_name')->nullable();
            $table->string('certified_by_designation')->nullable();
            $table->unsignedBigInteger('approved_by_id')->nullable();
            $table->string('approved_by_name')->nullable();
            $table->string('approved_by_designation')->nullable();
            $table->string('uuid')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index('uuid');
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

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
            $table->string('annex')->nullable();
            $table->string('status')->nullable();
            $table->string('remarks')->nullable();
            $table->float('total',15,2)->nullable();
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

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormRoutesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_routes', function (Blueprint $table) {
            $table->id();
            $table->string('route_type')->nullable();
            $table->string('status')->nullable();
            $table->string('remarks')->nullable();
            $table->unsignedBigInteger('remarks_by_id')->nullable();
            $table->unsignedBigInteger('origin_office_id')->nullable();
            $table->unsignedBigInteger('from_office_id')->nullable();
            $table->unsignedBigInteger('to_office_id')->nullable();
            $table->unsignedBigInteger('form_routable_id')->nullable();
            $table->string('form_routable_type')->nullable();
            $table->unsignedBigInteger('form_process_id')->nullable();
            $table->timestamps();
            $table->foreign('remarks_by_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('form_process_id')->references('id')->on('form_processes')->onDelete('cascade');
            $table->foreign('origin_office_id')->references('id')->on('libraries')->onDelete('set null');
            $table->foreign('from_office_id')->references('id')->on('libraries')->onDelete('set null');
            $table->foreign('to_office_id')->references('id')->on('libraries')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('form_routes');
    }
}

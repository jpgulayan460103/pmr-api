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
            $table->string('forwarded_remarks')->nullable();
            $table->unsignedBigInteger('owner_id')->nullable();
            $table->unsignedBigInteger('forwarded_by_id')->nullable();
            $table->unsignedBigInteger('remarks_by_id')->nullable();
            $table->unsignedBigInteger('origin_office_id')->nullable();
            $table->unsignedBigInteger('from_office_id')->nullable();
            $table->unsignedBigInteger('to_office_id')->nullable();
            $table->unsignedBigInteger('form_routable_id')->nullable();
            $table->string('form_routable_type')->nullable();
            $table->unsignedBigInteger('form_process_id')->nullable();
            $table->string('action_taken')->nullable();
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
        Schema::dropIfExists('form_routes');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormProcessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_processes', function (Blueprint $table) {
            $table->id();
            $table->string('process_description')->nullable();
            $table->text('form_routes')->nullable();
            $table->string('form_type')->nullable();
            $table->unsignedBigInteger('office_id')->nullable();
            $table->string('office_type')->nullable();
            $table->timestamps();

            $table->foreign('office_id')->references('id')->on('libraries')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('form_processes');
    }
}

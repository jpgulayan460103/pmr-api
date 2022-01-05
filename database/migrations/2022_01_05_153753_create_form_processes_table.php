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
            $table->string('form_type');
            $table->boolean('is_done')->nullable();
            $table->unsignedBigInteger('form_processable_id')->nullable();
            $table->string('form_processable_type')->nullable();
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
        Schema::dropIfExists('form_processes');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSignatoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('signatories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('office_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('designation')->nullable();
            $table->string('title')->nullable();
            $table->string('signatory_type')->nullable();
            $table->timestamps();
            $table->foreign('office_id')->references('id')->on('libraries')->onDelete('set null');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('signatories');
    }
}

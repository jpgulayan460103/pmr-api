<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEndUserReference extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('purchase_requests', function (Blueprint $table) {
            $table->foreign('end_user')->references('id')->on('libraries')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('purchase_requests', function (Blueprint $table) {
            $table->dropForeign(['end_user']);
        });
    }
}

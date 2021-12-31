<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserInformationLibraries extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_informations', function (Blueprint $table) {
            $table->unsignedBigInteger('signatory_id')->nullable();
            $table->unsignedBigInteger('section_id')->nullable();
            $table->foreign('signatory_id')->references('id')->on('libraries')->onDelete('set null');
            $table->foreign('section_id')->references('id')->on('libraries')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_informations', function (Blueprint $table) {
            $table->dropForeign(['signatory_id']);
            $table->dropForeign(['section_id']);
            $table->dropColumn('signatory_id');
            $table->dropColumn('section_id');
        });
    }
}

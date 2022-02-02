<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupplierContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supplier_contacts', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('address')->nullable();
            $table->string('email_address')->nullable();
            $table->unsignedBigInteger('supplier_id')->nullable();
            $table->timestamps();
            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('cascade');
        });
        Schema::table('quotations', function (Blueprint $table) {
            $table->unsignedBigInteger('supplier_contact_id')->nullable();
            $table->foreign('supplier_contact_id')->references('id')->on('supplier_contacts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('quotations', function (Blueprint $table) {
            $table->dropForeign(['supplier_contact_id']);
            $table->dropColumn('supplier_contact_id');
        });
        Schema::dropIfExists('supplier_contacts');
    }
}

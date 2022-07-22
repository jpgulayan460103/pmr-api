<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequisitionIssuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requisition_issues', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('fund_cluster')->nullable();
            $table->string('center_code')->nullable();
            $table->string('purpose')->nullable();
            $table->string('recommendation')->nullable();
            $table->date('ris_date')->nullable();
            $table->string('ris_number')->nullable();
            $table->boolean('from_ppmp')->nullable();
            $table->string('status')->nullable();
            $table->string('remarks')->nullable();
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->unsignedBigInteger('end_user_id')->nullable();
            $table->unsignedBigInteger('requested_by_id')->nullable();
            $table->string('requested_by_name')->nullable();
            $table->string('requested_by_designation')->nullable();
            $table->date('requested_by_date')->nullable();
            $table->unsignedBigInteger('approved_by_id')->nullable();
            $table->string('approved_by_name')->nullable();
            $table->string('approved_by_designation')->nullable();
            $table->date('approved_by_date')->nullable();
            $table->string('issued_by_name')->nullable();
            $table->string('issued_by_designation')->nullable();
            $table->date('issued_by_date')->nullable();
            $table->string('received_by_name')->nullable();
            $table->string('received_by_designation')->nullable();
            $table->date('received_by_date')->nullable();
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
        Schema::dropIfExists('requisition_issues');
    }
}

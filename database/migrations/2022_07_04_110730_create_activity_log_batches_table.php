<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivityLogBatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection(config('activitylog.database_connection'))->create('activity_log_batches', function (Blueprint $table) {
            $table->id();
            $table->uuid('batch_uuid')->nullable();
            $table->string('form_type')->nullable();
            $table->nullableMorphs('subject', 'subject');
            $table->timestamps();
            $table->index('batch_uuid');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection(config('activitylog.database_connection'))->dropIfExists('activity_log_batches');
    }
}

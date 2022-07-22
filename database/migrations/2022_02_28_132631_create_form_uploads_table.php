<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormUploadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_uploads', function (Blueprint $table) {
            $table->id();
            $table->string('disk')->nullable();
            $table->string('upload_type')->nullable();
            $table->string('title')->nullable();
            $table->string('filename')->nullable();
            $table->string('filesize')->nullable();
            $table->string('file_directory')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('form_type')->nullable();
            $table->unsignedBigInteger('form_uploadable_id')->nullable();
            $table->string('form_uploadable_type')->nullable();
            $table->string('form_attached')->nullable();
            $table->unsignedBigInteger('form_attachable_id')->nullable();
            $table->string('form_attachable_type')->nullable();
            $table->boolean('is_removable')->nullable();
            $table->unsignedBigInteger('parent_id')->nullable();
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
        Schema::dropIfExists('form_uploads');
    }
}

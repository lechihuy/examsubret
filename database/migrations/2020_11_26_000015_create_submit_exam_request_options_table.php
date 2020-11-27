<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubmitExamRequestOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('submit_exam_request_options', function (Blueprint $table) {
            $table->string('key', 100);
            $table->string('label', 100);
            $table->longText('value')->nullable();  
        });

        Schema::table('submit_exam_request_options', function (Blueprint $table) {
            $table->unsignedBigInteger('submit_exam_request_id');
            $table->foreign('submit_exam_request_id')
                ->references('id')->on('submit_exam_requests')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('submit_exam_request_options');
    }
}

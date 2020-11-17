<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReturnExamRequestOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('return_exam_request_options', function (Blueprint $table) {
            $table->string('key', 100);
            $table->string('label', 100);
            $table->longText('value')->nullable();  
        });

        Schema::table('return_exam_request_options', function (Blueprint $table) {
            $table->unsignedBigInteger('return_exam_request_id');
            $table->foreign('return_exam_request_id')
                ->references('id')->on('return_exam_requests')
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
        Schema::dropIfExists('return_exam_request_options');
    }
}

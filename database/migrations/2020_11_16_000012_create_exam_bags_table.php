<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamBagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_bags', function (Blueprint $table) {
            $table->id();
            $table->string('class', 20);
            $table->string('exam_room', 20);
            $table->unsignedInteger('exam_quantity');
            $table->unsignedInteger('paper_quantity');
        });

        Schema::table('exam_bags', function (Blueprint $table) {
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
        Schema::dropIfExists('exam_bags');
    }
}

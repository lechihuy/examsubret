<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamTimeAnswerTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_time_answer_type', function (Blueprint $table) {
            $table->unsignedBigInteger('exam_time_id');
            $table->foreign('exam_time_id')
                ->references('id')->on('exam_times')
                ->onDelete('cascade');

            $table->unsignedBigInteger('answer_type_id');
            $table->foreign('answer_type_id')
                ->references('id')->on('answer_types')
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
        Schema::dropIfExists('exam_time_answer_type');
    }
}

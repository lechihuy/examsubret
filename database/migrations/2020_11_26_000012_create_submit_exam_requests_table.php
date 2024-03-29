<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubmitExamRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('submit_exam_requests', function (Blueprint $table) {
            $table->id();
            $table->string('class');
            $table->string('semester', 50);
            $table->string('exam', 50);
            $table->unsignedInteger('times_1_exam_qty');
            $table->unsignedInteger('times_2_exam_qty')->nullable();           
            $table->json('exam_forms');
            $table->string('exam_form_note')->nullable();
            $table->enum('used_material', [0, 1, 2]);
            $table->string('used_material_note')->nullable();
            $table->boolean('has_answer');
            $table->boolean('has_point_ladder');
            $table->string('exam_type');
            $table->unsignedInteger('time')->comment('minutes');
            $table->boolean('is_verified')->default(false);
            $table->text('note')->nullable();
            $table->timestamps();
        });

        Schema::table('submit_exam_requests', function(Blueprint $table) {
            $table->unsignedBigInteger('admin_id')->nullable();
            $table->foreign('admin_id')
                ->references('id')->on('admins')
                ->onDelete('set null');

            $table->unsignedBigInteger('teacher_id');
            $table->foreign('teacher_id')
                ->references('id')->on('teachers')
                ->onDelete('cascade');

            $table->unsignedBigInteger('department_id');
            $table->foreign('department_id')
                ->references('id')->on('departments')
                ->onDelete('cascade');

            $table->unsignedBigInteger('major_id');
            $table->foreign('major_id')
                ->references('id')->on('majors')
                ->onDelete('cascade');

            $table->unsignedBigInteger('subject_id');
            $table->foreign('subject_id')
                ->references('id')->on('subjects')
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
        Schema::dropIfExists('submit_exam_requests');
    }
}

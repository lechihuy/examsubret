<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReturnExamRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('return_exam_requests', function (Blueprint $table) {
            $table->id();
            $table->enum('semester', [1, 2, 3]);
            $table->enum('exam', ['GK', 'CK'])->comment('GK-Giữa kỳ|CK-cuối kỳ');
            $table->unsignedInteger('exam_times');
            $table->unsignedInteger('time')->comment('minutes');
            $table->boolean('is_verified')->default(false);
            $table->text('note')->nullable();
            $table->timestamps();
        });

        Schema::table('return_exam_requests', function(Blueprint $table) {
            $table->unsignedBigInteger('admin_id')->nullable();
            $table->foreign('admin_id')
                ->references('id')->on('admins')
                ->onDelete('set null');

            $table->unsignedBigInteger('teacher_id');
            $table->foreign('teacher_id')
                ->references('id')->on('teachers')
                ->onDelete('cascade');

            $table->unsignedBigInteger('teacher_job_id');
            $table->foreign('teacher_job_id')
                ->references('id')->on('teacher_jobs')
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
        Schema::dropIfExists('return_exam_requests');
    }
}

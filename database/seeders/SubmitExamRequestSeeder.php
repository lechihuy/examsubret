<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubmitExamRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('submit_exam_requests')->insert([
            [
                'class' => 'K25CT',
                'department_id' => 14,
                'major_id' => 31,
                'subject_id' => 485,
                'semester' => 1,
                'exam' => 'MT',
                'times_1_exam_qty' => 1,
                'times_2_exam_qty' => 2,
                'exam_forms' => json_encode(['MC', 'ES1']),
                'exam_form_note' => 'Giáo viên chấm',
                'time' => 60,
                'used_material' => '0',
                'has_answer' => 0,
                'has_point_ladder' => 0,
                'exam_type' => 'PE',
                'teacher_id' => 1,
                'created_at' => now()->addMonth(3),
                'updated_at' => now()->addMonth(3)
            ],
        ]);

        DB::table('submit_exam_requests')->insert([
            [
                'class' => 'K25KE',
                'department_id' => 2,
                'major_id' => 30,
                'subject_id' => 91,
                'semester' => 1,
                'exam' => 'MT',
                'times_1_exam_qty' => 1,
                'exam_forms' => json_encode(['MC']),
                'exam_form_note' => 'Máy chấm',
                'time' => 60,
                'used_material' => '1',
                'used_material_note' => 'Vở học',
                'has_answer' => 0,
                'has_point_ladder' => 1,
                'exam_type' => 'BE',
                'teacher_id' => 1,
                'admin_id' => 1,
                'created_at' => now()->addMonth(12),
                'updated_at' => now()->addMonth(12)
            ],
        ]);

        DB::table('submit_exam_requests')->insert([
            [
                'class' => 'K25KS',
                'department_id' => 9,
                'major_id' => 24,
                'subject_id' => 327,
                'semester' => 1,
                'exam' => 'MT',
                'times_1_exam_qty' => 2,
                'exam_forms' => json_encode(['QA']),
                'exam_form_note' => 'Giáo viên chấm',
                'time' => 60,
                'used_material' => '2',
                'used_material_note' => 'Tài liệu eLearning',
                'has_answer' => 1,
                'has_point_ladder' => 0,
                'exam_type' => 'BE',
                'teacher_id' => 1,
                'admin_id' => 1,
                'is_verified' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}

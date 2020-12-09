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
                'department_id' => 14,
                'major_id' => 31,
                'subject_id' => 485,
                'semester' => 1,
                'exam' => 'MT',
                'times_1' => json_encode([
                    'origin_exam_qty' => 1,
                    'exam_code_qty' => 4,
                ]),
                'forms' => json_encode(['MC']),
                'time' => 60,
                'teacher_id' => 1,
                'created_at' => now()->addMonth(3),
                'updated_at' => now()->addMonth(3)
            ],
        ]);

        DB::table('submit_exam_requests')->insert([
            [
                'department_id' => 2,
                'major_id' => 30,
                'subject_id' => 91,
                'semester' => 2,
                'exam' => 'ET',
                'times_1' => json_encode([
                    'origin_exam_qty' => 1,
                    'exam_code_qty' => 4,
                ]),
                'times_2' => json_encode([
                    'origin_exam_qty' => 1,
                    'exam_code_qty' => 4,
                ]),
                'forms' => json_encode(['MC', 'ES']),
                'time' => 150,
                'teacher_id' => 1,
                'admin_id' => 1,
                'created_at' => now()->addMonth(1),
                'updated_at' => now()->addMonth(1)
            ],
        ]);

        DB::table('submit_exam_requests')->insert([
            [
                'department_id' => 9,
                'major_id' => 24,
                'subject_id' => 327,
                'semester' => 2,
                'exam' => 'ET',
                'times_1' => json_encode([
                    'origin_exam_qty' => 1,
                    'exam_code_qty' => 4,
                ]),
                'times_2' => json_encode([
                    'origin_exam_qty' => 1,
                    'exam_code_qty' => 4,
                ]),
                'forms' => json_encode(['MC', 'ES']),
                'time' => 150,
                'teacher_id' => 1,
                'admin_id' => 1,
                'is_verified' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}

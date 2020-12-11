<?php

namespace App\Models\Tables;

class SubmitExamRequestTable extends Table
{
    public function __construct()
    {
        $this->column('subject')->label('học phần')->primaryColumn()->width(300)
            ->render('subexam.components.columns.subject');
        
        $this->column('status')->label('trạng thái')->width(100)
            ->render('subexam.components.columns.status');

        $this->column('year')->label('năm học')->width(110)
            ->render('subexam.components.columns.year');

        $this->column('class')->label('nhóm LHP')->width(110)
            ->render('subexam.components.columns.class');

        $this->column('semester')->label('học kỳ')->width(80)
            ->render('subexam.components.columns.semester');

        $this->column('exam')->label('kỳ thi')->width(80)
            ->render('subexam.components.columns.exam');

        $this->column('time')->label('thời gian thi')->width(120)
            ->render('subexam.components.columns.time');

        $this->column('exam_forms')->label('hình thức thi')->width(160)
            ->render('subexam.components.columns.exam-forms');

        $this->column('times_1_exam_qty')->label('số đề lần 1')->width(80)
            ->render('subexam.components.columns.times-1-exam-qty');

        $this->column('times_2_exam_qty')->label('số đề lần 2')->width(80)
            ->render('subexam.components.columns.times-2-exam-qty');

        $this->column('used_material')->label('Được dùng tài liệu')->width(180)
            ->render('subexam.components.columns.used-material');

        $this->column('has_answer')->label('Kèm đáp án')->width(80)
            ->render('subexam.components.columns.has-answer');

        $this->column('has_point_ladder')->label('Kèm thang điểm')->width(110)
            ->render('subexam.components.columns.has-point-ladder');

        $this->column('exam_type')->label('Loại đề thi')->width(150)
            ->render('subexam.components.columns.exam-type');

        $this->column('teacher')->label('Giảng viên')->width(150)
            ->isVisible(auth('admin')->check())
            ->render('subexam.components.columns.teacher');

        $this->column('created_at')->label('Ngày tạo')->width(120)
            ->render('subexam.components.columns.created-at');

        $this->column('updated_at')->label('Lần cuối sửa đổi')->width(120)
            ->render('subexam.components.columns.updated-at');
    }
}
<?php

namespace App\Models\Tables;

class SubjectTable extends Table
{
    public function __construct()
    {
        $this->column('name')->label('tên học phần')->primaryColumn()->width(300)
            ->render('subject.components.columns.name');
        
        $this->column('code')->label('mã học phần')->width(100)
            ->render('subject.components.columns.code');

        $this->column('status')->label('thuộc ngành')->width(100)
            ->render('subject.components.columns.department');
    }
}
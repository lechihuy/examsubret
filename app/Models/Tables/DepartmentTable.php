<?php

namespace App\Models\Tables;

class DepartmentTable extends Table
{
    public function __construct()
    {
        $this->column('name')->label('tên khoa')->primaryColumn()->width(300)
            ->render('department.components.columns.name');
        
        $this->column('code')->label('mã khoa')->width(100)
            ->render('department.components.columns.code');

        $this->column('major')->label('số ngành')->width(100)
            ->render('department.components.columns.major');

        $this->column('subject')->label('số môn')->width(100)
            ->render('department.components.columns.subject');
    }
}
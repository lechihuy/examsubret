<?php

namespace App\Models\Tables;

class DepartmentTable extends Table
{
    public function __construct()
    {
        $this->column('subject')->label('tên khoa')->primaryColumn()->width(300)
            ->render('department.components.columns.name');
        
        $this->column('status')->label('mã khoa')->width(100)
            ->render('department.components.columns.code');
    }
}
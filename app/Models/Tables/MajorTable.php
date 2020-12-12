<?php

namespace App\Models\Tables;

class MajorTable extends Table
{
    public function __construct()
    {
        $this->column('name')->label('tên ngành')->primaryColumn()->width(300)
            ->render('major.components.columns.name');
        
        $this->column('code')->label('mã ngành')->width(100)
            ->render('major.components.columns.code');

        $this->column('status')->label('thuộc ngành')->width(100)
            ->render('major.components.columns.department');
    }
}
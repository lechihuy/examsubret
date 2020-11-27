<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function majors()
    {
        return $this->belongsToMany('App\Models\Major', 'department_major', 'department_id', 'major_id');
    }

    public function subjects()
    {
        return $this->belongsToMany('App\Models\Subject', 'department_subject', 'department_id', 'subject_id');
    }
}

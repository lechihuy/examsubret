<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherActivityLog extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'message',
        'teacher_id'
    ];
}

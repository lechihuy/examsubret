<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherJob extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $primaryKey = null;

    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'department_id',
        'major_id',
        'subject_id',
        'teacher_id'
    ];

    public function department()
    {
        return $this->hasOne('App\Models\Department', 'id', 'department_id');
    }

    public function major()
    {
        return $this->hasOne('App\Models\Major', 'id', 'major_id');
    }

    public function subject()
    {
        return $this->hasOne('App\Models\Subject', 'id', 'subject_id');
    }
}

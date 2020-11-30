<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Department;
use App\Models\Major;
use App\Models\Subject;

class TeacherJob extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $primaryKey = 'teacher_id';

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

    public static function isValid($job)
    {
        return Department::where('id', $job['department_id'])->exists()
            && Major::where('id', $job['major_id'])->exists()
            && Subject::where('id', $job['subject_id'])->exists();
    }

    public function detail()
    {
        return $this->with('department', 'major', 'subject')->get();
    }

    public function teacher()
    {
        return $this->hasOne('App\Models\Teacher', 'id', 'teacher_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SubmitExamRequest extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'department_id',
        'major_id',
        'subject_id',
        'semester',
        'exam',
        'times_1',
        'times_2',
        'forms',
        'time',
        'note'
    ];

    public function department()
    {
        return $this->belongsTo('App\Models\Department', 'department_id');
    }

    public function major()
    {
        return $this->belongsTo('App\Models\Major', 'major_id');
    }

    public function subject()
    {
        return $this->belongsTo('App\Models\Subject', 'subject_id');
    }

    public function teacher()
    {
        return $this->belongsTo('App\Models\Teacher', 'teacher_id');
    }

    public static function list($filter = [], $select = ['*'])
    {
        $examsubs = static::select($select);
            
        // Status
        if (isset($filter['status']) && $filter['status'] != 'all') {
            if ($filter['status'] == 2) {
                $examsubs->where('admin_id', null);
            } else {
                $examsubs->where('is_verified', $filter['status'])
                    ->whereNotNull('admin_id');
            }
        }

        // Department ID
        if (isset($filter['department_id']) && $filter['department_id'] != 'all') {
            $examsubs->where('department_id', $filter['department_id']);
        } 

        // Major ID
        if (isset($filter['major_id']) && $filter['major_id'] != 'all') {
            $examsubs->where('major_id', $filter['major_id']);
        } 

        // Subject ID
        if (isset($filter['subject_id']) && $filter['subject_id'] != 'all') {
            $examsubs->where('subject_id', $filter['subject_id']);
        } 

        // Teacher ID
        if (isset($filter['teacher_id']) && $filter['teacher_id'] != 'all') {
            $examsubs->where('teacher_id', $filter['teacher_id']);
        } 
        
        // Semester
        if (isset($filter['semester']) && $filter['semester'] != 'all') {
            $examsubs->where('semester', $filter['semester']);
        }
        
        // Exam
        if (isset($filter['exam']) && $filter['exam'] != 'all') {
            $examsubs->where('exam', $filter['exam']);
        }

        // Forms
        if (isset($filter['forms']) && $filter['forms'] != 'all') {
            $forms = explode(',', $filter['forms']);

            $examsubs->whereJsonContains('forms', $forms);
        }

        // Created at
        if (isset($filter['created_at'])) {
            if ($filter['created_at'] == 'desc') {
                $examsubs->latest('created_at');
            } else {
                $examsubs->oldest('created_at');
            }
        } else {
            $examsubs->latest('created_at');
        }

        return $examsubs->with('department', 'major', 'subject')->paginate(20);
    }

    public function getTimes1Attribute($value)
    {
        return json_decode($value);
    }

    public function getTimes2Attribute($value)
    {
        return json_decode($value);
    }

    public function getFormsAttribute($value)
    {
        return json_decode($value, true);
    }

    public static function getYearList()
    {
        return static::select(DB::raw('YEAR(created_at) as year'))
            ->distinct()->orderBy('year', 'desc')->get()->pluck('year')->toArray();
    }
}

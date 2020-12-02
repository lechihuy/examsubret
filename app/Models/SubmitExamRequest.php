<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    protected $casts = [
        'times_1' => 'collection',
        'times_2' => 'collection',
    ];

    public function department()
    {
        return $this->hasOne('App\Models\Department', 'id');
    }

    public function major()
    {
        return $this->hasOne('App\Models\Major', 'id');
    }

    public function subject()
    {
        return $this->hasOne('App\Models\Subject', 'id');
    }

    public static function list($filter = [], $select = ['*'])
    {
        $examsubs = static::select($select);
            
        // Teacher ID
        if (isset($filter['teacher_id']) && $filter['teacher_id'] != 'all') {
            $filter['teacher_id'] = $filter['teacher_id'] == 'none' ? null : $filter['teacher_id'];

            $examsubs->where('teacher_id', $filter['teacher_id']);
        } 

        // Admin ID
        if (isset($filter['admin_id']) && $filter['admin_id'] != 'all') {
            $filter['admin_id'] = $filter['admin_id'] == 'none' ? null : $filter['admin_id'];

            $examsubs->where('admin_id', $filter['admin_id']);
        }  

        // Is verified
        if (isset($filter['is_verifed']) && $filter['is_verifed'] != 'all') {
            $examsubs->where('is_verifed', $filter['is_verifed']);
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
}

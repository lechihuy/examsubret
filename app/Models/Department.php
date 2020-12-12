<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Tables\DepartmentTable;

class Department extends Model
{
    use HasFactory;

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'code',
    ];

    public static function table() 
    {
        return new DepartmentTable;
    }

    public function majors()
    {
        return $this->belongsToMany('App\Models\Major', 'department_major', 'department_id', 'major_id');
    }

    public function subjects()
    {
        return $this->belongsToMany('App\Models\Subject', 'department_subject', 'department_id', 'subject_id');
    }

    public static function list($filter = [], $select = ['*'])
    {
        $departments = static::select($select);

        // Name
        if (isset($filter['name'])) {
            $departments->where('name', 'like', '%'.$filter['name'].'%');

            $departments->orderByRaw('
                (CASE 
                    WHEN (name LIKE ?) THEN 1
                    WHEN (name LIKE ?) THEN 1
                    WHEN (name LIKE ?) THEN 1
                    ELSE 4
                END)'
            , [$filter['name'], $filter['name'].'%', '%'.$filter['name']]);
        }

        // Code
        if (isset($filter['code'])) {
            $departments->where('code', 'like', '%'.$filter['code'].'%');

            $departments->orderByRaw('
                (CASE 
                    WHEN (code LIKE ?) THEN 1
                    WHEN (code LIKE ?) THEN 1
                    WHEN (code LIKE ?) THEN 1
                    ELSE 4
                END)'
            , [$filter['code'], $filter['code'].'%', '%'.$filter['code']]);
        }

        if (isset($filter['pagination']) && $filter['pagination'] == false) {
            return $departments->get();
        } else {
            return $departments->paginate(20);
        }
    }
}

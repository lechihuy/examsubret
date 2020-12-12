<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use App\Models\Tables\SubjectTable;

class Subject extends Model
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
        return new SubjectTable;
    }

    public function departments()
    {
        return $this->belongsToMany('App\Models\Department', 'department_subject');
    }

    public static function list($filter = [], $select = ['*'])
    {
        $subjects = static::select($select);

        // Name
        if (isset($filter['name'])) {
            $subjects->where('name', 'like', '%'.$filter['name'].'%');

            $subjects->orderByRaw('
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
            $subjects->where('code', 'like', '%'.$filter['code'].'%');

            $subjects->orderByRaw('
                (CASE 
                    WHEN (code LIKE ?) THEN 1
                    WHEN (code LIKE ?) THEN 1
                    WHEN (code LIKE ?) THEN 1
                    ELSE 4
                END)'
            , [$filter['code'], $filter['code'].'%', '%'.$filter['code']]);
        }

        // Department ID
        if (isset($filter['department_id']) && $filter['department_id'] != 'all') {
            $subjects->whereHas('departments', function($q) use ($filter) {
                $q->where('id', $filter['department_id']);
            });
        } 

        if (isset($filter['pagination']) && $filter['pagination'] == false) {
            return $subjects->get();
        } else {
            return $subjects->paginate(20);
        }
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Tables\MajorTable;

class Major extends Model
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
        'department_id'
    ];

    public static function table() 
    {
        return new MajorTable;
    }

    public function department()
    {
        return $this->belongsTo('App\Models\Department', 'department_id');
    }

    public static function list($filter = [], $select = ['*'])
    {
        $majors = static::select($select);

        // Name
        if (isset($filter['name'])) {
            $majors->where('name', 'like', '%'.$filter['name'].'%');

            $majors->orderByRaw('
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
            $majors->where('code', 'like', '%'.$filter['code'].'%');

            $majors->orderByRaw('
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
            $majors->where('department_id', $filter['department_id']);
        } 

        if (isset($filter['pagination']) && $filter['pagination'] == false) {
            return $majors->get();
        } else {
            return $majors->paginate(20);
        }
    }
}

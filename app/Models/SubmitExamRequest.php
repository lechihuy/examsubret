<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use App\Models\Tables\SubmitExamRequestTable;

class SubmitExamRequest extends Model
{
    use HasFactory;

    public static $data = [
        'semesters' => [1, 2, 3],

        'exams' => [
            'MT' => 'Giữa kỳ', 
            'ET' => 'Cuối kỳ'
        ],

        'exam_forms' => [
            'MC' => 'Trắc nghiệm',
            'ES1' => 'Tự luận',
            'PT' => 'Thực hành',
            'QA' => 'Vấn đáp',
            'ES2' => 'Tiểu luận'
        ],

        'used_material' => ['Không', 'Có', 'Khác'],

        'has_answer' => ['Không', 'Có'],

        'has_point_ladder' => ['Không', 'Có'],

        'exam_types' => [
            'PE' => 'Phát cho mỗi SV một đề',
            'BE' => 'Chỉ cần chép lên bảng',
            'CE' => 'Thi phòng máy tính'
        ],

        'status' => [
            'UNSEEN' => 'Chưa xem',
            'VERIFIED' => 'Đã xác nhận',
            'PROCESSING' => 'Đang xử lý',
        ],
        
        'actions' => [
            'ACCEPT_SUBEXAM' => 'Tiếp nhận yêu cầu',
            'CANCEL_ACCEPT_SUBEXAM' => 'Hủy tiếp nhận yêu cầu',
            'VERIFY_SUBEXAM' => 'Xác nhận yêu cầu',
            'CANCEL_VERIFY_SUBEXAM' => 'Hủy xác nhận yêu cầu',
        ]
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'class',
        'department_id',
        'major_id',
        'subject_id',
        'semester',
        'exam',
        'times_1_exam_qty',
        'times_2_exam_qty',
        'exam_forms',
        'exam_form_note',
        'used_material',
        'used_material_note',
        'has_answer',
        'has_point_ladder',
        'exam_type',
        'time',
        'note'
    ];

    public static function table() 
    {
        return new SubmitExamRequestTable;
    }

    public static function data($key) {
        return static::$data[$key] ?? null;
    }

    /*
    |--------------------------------------------------------------------------
    | Relative methods
    |--------------------------------------------------------------------------
    */
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

    public function admin()
    {
        return $this->belongsTo('App\Models\Admin', 'admin_id');
    }

    /*
    |--------------------------------------------------------------------------
    | Helper methods
    |--------------------------------------------------------------------------
    */
    public static function list($filter = [], $select = ['*'])
    {
        $examsubs = static::select($select);

        // Year
        if (isset($filter['year']) && $filter['year'] != 'all') {
            $examsubs->whereYear('created_at', $filter['year']);
        } 
            
        // Status
        if (isset($filter['status']) && $filter['status'] != 'all') {
            if ($filter['status'] == 'UNSEEN') {
                $examsubs->where('admin_id', null);
            } else {
                $isVerified = $filter['status'] == 'VERIFIED' ? 1 : 0;
                $examsubs->where('is_verified', $isVerified)
                    ->whereNotNull('admin_id');
            }
        }

        // Class
        if (isset($filter['class']) && $filter['class'] != 'all') {
            $examsubs->where('class', $filter['class']);
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

        // Exam forms
        if (isset($filter['exam_forms']) && $filter['exam_forms'] != 'all') {
            $examForms = explode(',', $filter['exam_forms']);

            $examsubs->whereJsonContains('exam_forms', $examForms);
        }

        // Used material
        if (isset($filter['used_material']) && $filter['used_material'] != 'all') {
            $examsubs->where('used_material', $filter['used_material']);
        }

        // Has answer
        if (isset($filter['has_answer']) && $filter['has_answer'] != 'all') {
            $examsubs->where('has_answer', $filter['has_answer']);
        }

        // Has point ladder
        if (isset($filter['has_point_ladder']) && $filter['has_point_ladder'] != 'all') {
            $examsubs->where('has_point_ladder', $filter['has_point_ladder']);
        }

        // Exam type
        if (isset($filter['exam_type']) && $filter['exam_type'] != 'all') {
            $examsubs->where('exam_type', $filter['exam_type']);
        }

        // Search
        if (isset($filter['k'])) {
            $examsubs->whereHas('subject', function($q) use ($filter) {
                $q->where('name', 'like', '%'.$filter['k'].'%');
                $q->orderByRaw('
                    (CASE 
                        WHEN (name LIKE ?) THEN 1
                        WHEN (name LIKE ?) THEN 1
                        WHEN (name LIKE ?) THEN 1
                        ELSE 4
                    END)'
                , [$filter['k'], $filter['k'].'%', '%'.$filter['k']]);
            });
           
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

        $examsubs->with('department', 'major', 'subject');

        if (isset($filter['pagination']) && $filter['pagination'] == false) {
            return $examsubs->get();
        } else {
            return $examsubs->paginate(20);
        }
    }

    protected static function cursorCounter($filter)
    {
        return isset($filter['teacher_id']) ? static::where('teacher_id', $filter['teacher_id']) : new static;
    }

    public static function counter($filter = [])
    {
        $all = static::cursorCounter($filter);

        $isVerified = static::cursorCounter($filter)->where('is_verified', 1);

        $pending = static::cursorCounter($filter)->where('is_verified', 0)
            ->whereNotNull('admin_id');

        $unread = static::cursorCounter($filter)->whereNull('admin_id');

        return [
            'all' => $all->count(),
            'is_verified' => $isVerified->count(),
            'pending' => $pending->count(),
            'unread' => $unread->count(),
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Accessor methods
    |--------------------------------------------------------------------------
    */
    public function getExamFormsAttribute($value)
    {
        return json_decode($value, true);
    }

    public static function getYearList()
    {
        return static::select(DB::raw('YEAR(created_at) as year'))
            ->distinct()->orderBy('year', 'desc')->get()->pluck('year')->toArray();
    }

    public static function getClassList()
    {
        return static::select('class')->get()->pluck('class')->toArray();
    }

    public function status()
    {
        $status = static::data('status');

        if ($this->admin_id == null) {
            return $status['UNSEEN'];
        } else if ($this->is_verified == 1) {
            return $status['VERIFIED'];
        } else if ($this->is_verified == 0) {
            return $status['PROCESSING'];
        }
    }

    public function examText()
    {
        return static::data('exams')[$this->exam];
    }

    public function schoolYear()
    {
        $year = $this->created_at->format('Y');

        return $year.' - '.($year + 1);
    }

    public function timeText()
    {
        return $this->time.' phút';
    }

    public function examFormsText()
    {
        $examForms = static::data('exam_forms');

        return implode(', ', 
            array_map(function($value) use ($examForms) {
                return $examForms[$value];
            }, $this->exam_forms)
        );
    }

    public function usedMaterialText()
    {
        return static::data('used_material')[$this->used_material];
    }

    public function hasAnswerText()
    {
        return static::data('has_answer')[$this->has_answer];
    }

    public function hasPointLadderText()
    {
        return static::data('has_point_ladder')[$this->has_point_ladder];
    }

    public function examTypeText()
    {
        return static::data('exam_types')[$this->exam_type];
    }
}

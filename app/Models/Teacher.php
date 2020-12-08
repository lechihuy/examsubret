<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Traits\Common;

class Teacher extends Authenticatable 
{
    use HasFactory, Notifiable, Common;

    const NAME = 'Giảng viên';

    protected $logTable = 'teacher_activity_logs';
    
    protected $foreignKeyLogTable = 'teacher_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fullname',
        'email',
        'username',
        'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    public static function canCreate($email)
    {
        return static::where('email', $email)->doesntExist();
    }

    public function createSubmitExamRequest($data)
    {
        $this->log('create_subexam');

        $data['times_1'] = json_encode($data['times_1']);
        $data['times_2'] = count($data['times_2']) ? json_encode($data['times_2']) : null;
        $data['forms'] = json_encode($data['forms']);
        
        return $this->submitExamRequests()->create($data);
    }

    public function updateSubmitExamRequest($id, $data)
    {
        $this->log('update_subexam', ['id' => $id]);

        $data['times_1'] = json_encode($data['times_1']);
        $data['times_2'] = count($data['times_2']) ? json_encode($data['times_2']) : null;
        $data['forms'] = json_encode($data['forms']);

        return $this->submitExamRequests()->where('id', $id)->update($data);
    }

    public function destroyListSubmitExamRequest($subexams)
    {
        foreach ($subexams as $subexam) {
            $this->log('destroy_subexam', ['id' => $subexam]);
        }

        return $this->submitExamRequests()->whereIn('id', $subexams)->delete();
    }

    public function destroySubmitExamRequest($subexam)
    {
        $this->log('destroy_subexam', ['id' => $subexam]);

        return $this->submitExamRequests()->where('id', $subexam)->delete();
    }
}

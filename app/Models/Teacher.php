<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Traits\Log;

class Teacher extends Authenticatable 
{
    use HasFactory, Notifiable, Log;

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

    public function identification()
    {
        return $this->username;
    }

    public function submitExamRequests()
    {
        return $this->hasMany('App\Models\SubmitExamRequest');
    }

    public function createSubmitExamRequest($data)
    {

        $this->log('create_subexam');
        
        return $this->submitExamRequests()->create($data);
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

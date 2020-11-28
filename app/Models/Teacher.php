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

    public function updateProfile($data)
    {
        $this->log("Giảng viên {$this->identification()} vừa cập nhật hồ sơ.");
        return $this->update($data->toArray());
    }
}

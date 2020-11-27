<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Tymon\JWTAuth\Contracts\JWTSubject;

class Teacher extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fullname',
        'email',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public static function canCreate($email)
    {
        return static::where('email', $email)->doesntExist();
    }

    public function updateLastLogin()
    {
        $this->log("Giảng viên {$this->identification()} vừa đăng nhập.");
        $this->last_login_at = now();
        $this->save();
    }

    public function log($message)
    {
        return TeacherActivityLog::create([
            'message' => $message,
            'teacher_id' => $this->id,
        ]);
    }

    public function identification()
    {
        return $this->fullname ?? $this->email;
    }

    public function logout()
    {
        $this->log("Giảng viên {$this->identification()} vừa đăng xuất.");
        auth()->logout();
    }

    public function updateProfile($data)
    {
        $this->log("Giảng viên {$this->identification()} vừa cập nhật hồ sơ.");
        return $this->update($data->toArray());
    }
}

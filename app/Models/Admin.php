<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Traits\Log;

class Admin extends Authenticatable 
{
    use HasFactory, Notifiable, Log;

    const NAME = 'Quản trị viên';

    protected $logTable = 'admin_activity_logs';
    protected $foreignKeyLogTable = 'admin_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fullname',
        'email',
        'phone_number',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    public function identification()
    {
        return $this->username;
    }

    public function updateProfile($data)
    {
        if ($data->has('password')) {
            $this->log("Quản trị viên {$this->identification()} vừa đổi mật khẩu.");
            $data->put('last_change_password_at', now());
        }

        $this->log("Quản trị viên {$this->identification()} vừa cập nhật hồ sơ.");
        return $this->update($data->toArray());
    }
}

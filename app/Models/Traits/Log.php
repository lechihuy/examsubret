<?php

namespace App\Models\Traits;

use Illuminate\Support\Facades\DB;

trait Log
{
    public function log($code, $data = [])
    {
        $attrs = [
            'subject' => static::NAME,
            'identification' => $this->identification(),
        ];

        $attrs = array_merge($attrs, $data);

        $message = trans("log.{$code}", $attrs);
        
        return DB::table($this->logTable)->insert([
            'message' => $message,
            $this->foreignKeyLogTable => $this->id,
        ]);
    }

    public function updateLastLogin()
    {
        $this->log('login');
        $this->last_login_at = now();
        $this->save();
    }

    public function updateLastChangePassword()
    {
        $this->log('change_password');
        $this->last_change_password_at = now();
        $this->save();
    }

    public function hasChangedPassword()
    {
        return (bool) $this->last_change_password_at;
    }

    public function logs()
    {
        return DB::table($this->logTable)->where($this->foreignKeyLogTable, $this->id)->get();
    }
}
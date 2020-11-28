<?php

namespace App\Models\Traits;

use Illuminate\Support\Facades\DB;

trait Log
{
    public function log($code)
    {
        $message = trans("log.{$code}", [
            'subject' => static::NAME,
            'identification' => $this->identification(),
        ]);
        
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
}
<?php

namespace App\Models\Traits;

use Illuminate\Support\Facades\DB;
use App\Models\SubmitExamRequest;

trait Common
{
    /*
    |--------------------------------------------------------------------------
    | Fundation methods
    |--------------------------------------------------------------------------
    */
    public function identification()
    {
        return $this->fullname ?? $this->username;
    }

    /*
    |--------------------------------------------------------------------------
    | Log methods
    |--------------------------------------------------------------------------
    */
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

    public function logs()
    {
        return DB::table($this->logTable)->where($this->foreignKeyLogTable, $this->id)->get();
    }

    /*
    |--------------------------------------------------------------------------
    | Relative methods
    |--------------------------------------------------------------------------
    */
    public function submitExamRequests()
    {
        return $this->hasMany('App\Models\SubmitExamRequest');
    }

    /*
    |--------------------------------------------------------------------------
    | Action methods
    |--------------------------------------------------------------------------
    */
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

    public function switchStatusListSubmitExamRequest($action, $subexams)
    {
        foreach ($subexams as $subexam) {
            $this->log('destroy_subexam', [
                'id' => $subexam, 
                'action' => config('data.subexam_actions')[$action],
            ]);
        }

        switch ($action) {
            case 'ACCEPT_SUBEXAM':
                $updates = ['admin_id' => $this->id];

                return SubmitExamRequest::whereIn('id', $subexams)->update($updates);
            break;

            case 'CANCEL_ACCEPT_SUBEXAM':
                $updates = ['admin_id' => null];
            break;

            case 'VERIFY_SUBEXAM':
                $updates = ['is_verified' => 1];
            break;

            case 'CANCEL_VERIFY_SUBEXAM':
                $updates = ['is_verified' => 0];
            break;
        }

        return $this->submitExamRequests()->whereIn('id', $subexams)->update($updates);
    }
}
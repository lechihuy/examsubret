<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Traits\Common;

class Admin extends Authenticatable 
{
    use HasFactory, Notifiable, Common;

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
                $updates = [
                    'admin_id' => $this->id,
                    'is_verified' => 0,
                ];

                return SubmitExamRequest::whereIn('id', $subexams)->update($updates);
            break;

            case 'CANCEL_ACCEPT_SUBEXAM':
                $updates = [
                    'admin_id' => null,
                    'is_verified' => 0,
                ];
            break;

            case 'VERIFY_SUBEXAM':
                $updates = [
                    'admin_id' => $this->id,
                    'is_verified' => 1,
                ];

                return SubmitExamRequest::whereIn('id', $subexams)->update($updates);
            break;

            case 'CANCEL_VERIFY_SUBEXAM':
                $updates = [
                    'is_verified' => 0
                ];
            break;
        }

        return $this->submitExamRequests()->whereIn('id', $subexams)->update($updates);
    }

    public function switchStatusSubmitExamRequest($action, $subexam)
    {
        $this->log('switch_status_subexam', [
            'id' => $subexam, 
            'action' => SubmitExamRequest::data('actions')[$action],
        ]);

        switch ($action) {
            case 'ACCEPT_SUBEXAM':
                $updates = [
                    'admin_id' => $this->id,
                    'is_verified' => 0,
                ];

                return SubmitExamRequest::where('id', $subexam)->update($updates);
            break;

            case 'CANCEL_ACCEPT_SUBEXAM':
                $updates = [
                    'admin_id' => null,
                    'is_verified' => 0,
                ];
            break;

            case 'VERIFY_SUBEXAM':
                $updates = [
                    'admin_id' => $this->id,
                    'is_verified' => 1,
                ];

                return SubmitExamRequest::where('id', $subexam)->update($updates);
            break;

            case 'CANCEL_VERIFY_SUBEXAM':
                $updates = [
                    'admin_id' => $this->id,
                    'is_verified' => 0,
                ];
            break;
        }

        return $this->submitExamRequests()->where('id', $subexam)->update($updates);
    }

    public function createDepartment($data)
    {
        $this->log('create_department');

        return Department::create($data);
    }

    public function destroyListDepartment($departments)
    {
        foreach ($departments as $department) {
            $this->log('destroy_department', ['id' => $department]);
        }

        return Department::whereIn('id', $departments)->delete();
    }

    public function destroyDepartment($department)
    {
        $this->log('destroy_department', ['id' => $department]);

        return Department::where('id', $department)->delete();
    }

    public function updateDepartment($id, $data)
    {
        $this->log('edit_department', ['id' => $id]);

        return Department::where('id', $id)->update($data);
    }

    public function createMajor($data)
    {
        $this->log('create_major');

        return Major::create($data);
    }

    public function destroyListMajor($majors)
    {
        foreach ($majors as $major) {
            $this->log('destroy_major', ['id' => $major]);
        }

        return Major::whereIn('id', $majors)->delete();
    }

    public function destroyMajor($major)
    {
        $this->log('destroy_major', ['id' => $major]);

        return Major::where('id', $major)->delete();
    }

    public function updateMajor($id, $data)
    {
        $this->log('edit_major', ['id' => $id]);

        return Major::where('id', $id)->update($data);
    }

    public function createSubject($data)
    {
        $this->log('create_subject');

        $subject = Subject::create($data);

        $data['department_id'] = explode(',', $data['department_id']);

        $subject->departments()->attach($data['department_id']);
    }

    public function destroyListSubject($subjects)
    {
        foreach ($subjects as $subject) {
            $this->log('destroy_subject', ['id' => $subject]);
        }

        return Subject::whereIn('id', $subjects)->delete();
    }

    public function destroySubject($subject)
    {
        $this->log('destroy_subject', ['id' => $subject]);

        return Subject::where('id', $subject)->delete();
    }

    public function updateSubject($id, $data)
    {
        $this->log('edit_subject', ['id' => $id]);

        Subject::where('id', $id)->update([
            'name' => $data['name'],
            'code' => $data['code'],
        ]);

        $data['department_id'] = explode(',', $data['department_id']);

        $subject = Subject::find($id);
        $subject->departments()->detach($subject->departments);
        $subject->departments()->attach($data['department_id']);
    }

    public function isAdmin()
    {
        return true;
    }
}

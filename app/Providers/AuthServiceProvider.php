<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

use App\Models\SubmitExamRequest;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('create-subexam', function($user) {
            return class_basename($user) === 'Teacher';
        });

        Gate::define('edit-subexam', function($user, $subexam) {
            return current_user()->submitExamRequests()->where('id', $subexam)->exists();
        });

        Gate::define('destroy-subexam', function($user, $subexams) {
            return current_user()->submitExamRequests()->whereIn('id', $subexams)->exists();
        });

        Gate::define('switch-status-subexam', function($user) {
            return auth('admin')->check();
        });

        Gate::define('export', function($user) {
            return auth('admin')->check();
        });
    }
}

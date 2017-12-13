<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();


        //
        // base update and edit
        Gate::define('basic-handle', function ($user, $entity) {
            if (isSuperAdmin()) return true;

            return ($entity->user_id === $user->id) ? true : false;
        });


        //
        // update within time
        Gate::define('update-within-time', function ($user, $entity, $time = 5) {
            if (isSuperAdmin()) return true;

            if (
                $entity->user_id === $user->id
                && $entity->created_at->addMinutes($time)->gte(Carbon::now())
            ) {
                return true;
            } else {
                return false;
            }
        });

        //
        // destroy
        Gate::define('destroy', function ($user, $entity) {
            if (isSuperAdmin()) return true;

            return ($entity->user_id === $user->id) ? true : false;
        });
    }
}

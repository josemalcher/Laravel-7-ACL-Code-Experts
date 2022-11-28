<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;

// use Illuminate\Auth\Access\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        'App\Models\Model' => 'App\Policies\ThreadPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        /* Gate::define('access-index-forum', function (User $user) {
             return $user->isAdmin();
         });*/

        if(!Schema::hasTable('resources')) return null;

        $resources = \App\Models\Resource::all();

        Gate::before(function ($user) {
            if ($user->isAdmin()) {
                return true;
            }
        });

        foreach ($resources as $resource) {
            Gate::define($resource->resource, function ($user) use ($resource) {
                return $resource->roles->contains($user->role);
            });
        }
        // dd(Gate::abilities());
    }
}

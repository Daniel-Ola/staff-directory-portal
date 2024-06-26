<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('admins', function($user) {
            if($user->access == '2' || $user->access == '1') return true;
        });

        Gate::define('superadmin', function($user) {
            return $user->access == 1;
        });

        Gate::define('grouphead', function ($user) {
            return $check = \App\SubsidiaryGroup::join('group_heads as gh', 'gh.group_id', 'subsidiary_groups.id')->where('gh.user_id', $user->id)->exists();
        });
    }
}

<?php

namespace App\Providers;

use App\Models\Permissions\Permission;
use App\Models\User;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::defaultView('vendor.pagination.tailwind');

        Gate::before(function (User $user, $ability) {
            if (Permission::getPermissionByVal($ability)) {
                return $user->hasPermissionTo($ability);
            }
        });
    }
}

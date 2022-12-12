<?php

namespace App\Providers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Settings;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::share('settings', Settings::all());
        Carbon::setLocale('id');
        Paginator::useBootstrap();
        Gate::define('pasien', function(User $user) {
            return $user->role === 1;
        });
        Gate::define('admin', function(User $user) {
            return $user->role === 2;
        });
        Gate::define('dokter', function(User $user) {
            return $user->role === 3;
        });
    }
}

<?php

namespace App\Providers;

use Spatie\Health\Facades\Health;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Spatie\Health\Checks\Checks\PingCheck;
use Spatie\Health\Checks\Checks\DatabaseCheck;
use Spatie\Health\Checks\Checks\UsedDiskSpaceCheck;

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
        Gate::define('viewWebTinker', function ($user = null) {
            return $user && $user -> email == 'jimmy@gmail.com';
        });


        Health::checks([
            UsedDiskSpaceCheck::new(),
            DatabaseCheck::new(),
            PingCheck::new()->url('http://localhost:8000'),
        ]);
    }
}

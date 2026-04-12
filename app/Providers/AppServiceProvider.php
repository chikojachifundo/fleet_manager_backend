<?php

namespace App\Providers;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\ServiceProvider;
use OwenIt\Auditing\Models\Audit;

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
        ResetPassword::createUrlUsing(function ($user, string $token) {
            return env('FRONTEND_URL') . "/reset-password?token={$token}&email={$user->email}";
        });

        Audit::creating(function ($audit) {
            $audit->ip_address = request()->ip();
            $audit->user_agent = request()->userAgent();
            $audit->url = request()->fullUrl();
        });
    }
}

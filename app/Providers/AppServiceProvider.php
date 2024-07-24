<?php

namespace App\Providers;

use App\Http\Interfaces\ITestService;
use App\Http\Services\TestService;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        // 1 way to bind interface with class 
        // app()->bind(ITestService::class, TestService::class);

        app()->bind(
            ITestService::class,
            function ($app) {
                return collect([
                    'test1' => app(TestService::class),
                ]);
            }
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        ResetPassword::createUrlUsing(function (object $notifiable, string $token) {
            return config('app.frontend_url') . "/password-reset/$token?email={$notifiable->getEmailForPasswordReset()}";
        });
    }
}

<?php

namespace App\Providers;

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
        $this->app->singleton(LoginUserCommand::class, function ($app) {
            return new LoginUserCommand();
        });

        $this->app->singleton(LogoutUserCommand::class, function ($app) {
            return new LogoutUserCommand();
        });

        $this->app->singleton(GetEmployeesQuery::class, function ($app) {
            return new GetEmployeesQuery();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}

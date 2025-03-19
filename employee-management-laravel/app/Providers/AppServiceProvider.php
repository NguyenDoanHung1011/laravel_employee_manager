<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Queries\GetEmployeesQuery;
use App\Commands\LoginUserCommand;
use App\Commands\LogoutUserCommand;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(GetEmployeesQuery::class);
        $this->app->singleton(LoginUserCommand::class);
        $this->app->singleton(LogoutUserCommand::class);
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

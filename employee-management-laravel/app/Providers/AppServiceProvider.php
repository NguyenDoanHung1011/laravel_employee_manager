<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Queries\GetEmployeesQuery;
use App\Commands\LoginEmployeeCommand;
use App\Commands\LogoutEmployeeCommand;
use App\Repositories\EmployeeRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(EmployeeRepository::class);
        $this->app->singleton(GetEmployeesQuery::class);
        $this->app->singleton(LoginEmployeeCommand::class);
        $this->app->singleton(LogoutEmployeeCommand::class);
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

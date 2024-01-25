<?php

namespace App\Providers;

use Filament\Facades\Filament;
use Illuminate\Support\ServiceProvider;
use App\Filament\Resources\CityResource;
use App\Filament\Resources\StateResource;
use App\Filament\Resources\CountryResource;
use App\Filament\Resources\EmployeeResource;
use App\Filament\Resources\DepartmentResource;

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
        //
    }
}

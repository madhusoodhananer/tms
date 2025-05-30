<?php

namespace App\Providers;

use Illuminate\Support\Facades\File;
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
        $migrationPaths = collect(File::directories(database_path('migrations')))
        ->prepend(database_path('migrations'))
        ->toArray();

        $this->loadMigrationsFrom($migrationPaths);
    }
}

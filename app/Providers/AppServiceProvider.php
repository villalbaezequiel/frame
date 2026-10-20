<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;
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
        // Routes use the legacy 'Backend\FooController@method' string syntax.
        $namespace = 'App\Http\Controllers';

        URL::setRootControllerNamespace($namespace);

        Route::middleware('web')
            ->namespace($namespace)
            ->group(base_path('routes/web.php'));
    }
}

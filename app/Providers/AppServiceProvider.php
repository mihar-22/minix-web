<?php

namespace Minix\Providers;

use Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->bootstrapWebRoutes();
    }

    public function register()
    {
        $this->registerIdeHelper();
    }

    /**
     * Setup routing to be managed by the frontend router.
     */
    public function bootstrapWebRoutes()
    {
        Route::middleware('web')->group(function () {
            Route::get('/', function () {
                return view('master');
            });

            Route::get('{any?}', function () {
                return view('master');
            })->where('any', '^(?!api).*$');
        });
    }

    /**
     * Generate a file to help IDE provide more accurate autocompletion. Eg: Facades.
     */
    public function registerIdeHelper()
    {
        if ($this->app->environment() !== 'production') {
            $this->app->register(IdeHelperServiceProvider::class);
        }
    }
}

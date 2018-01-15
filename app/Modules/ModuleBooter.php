<?php

namespace Minix\Modules;

use Illuminate\Database\Eloquent\Factory;
use Illuminate\Support\Facades\Route;
use ReflectionClass;

trait ModuleBooter
{
    /**
     * "Booting" module function. Loads default into laravel.
     */
    public function bootModlule()
    {
        $this->mapApiRoutes();
        $this->loadMigrationsFrom($this->buildPath('database/migrations'));
        $this->loadFactoriesFrom($this->buildPath('database/factories'));
    }

    /**
     * Map the routes to the api endpoint.
     */
    public function mapApiRoutes()
    {
        $module = $this->getModuleName();

        Route::prefix('api')
            ->middleware('api')
            ->namespace(config('app.name').'\\'.$module.'\\Http\\Controllers')
            ->group($this->buildPath('src/Http/routes.php'));
    }

    /**
     * Load the factories from the given directory.
     *
     * @param string $path
     */
    public function loadFactoriesFrom($path)
    {
        if (!app()->environment('production')) {
            app(Factory::class)->load($path);
        }
    }

    /**
     * Build path to files in the module root directory.
     *
     * @param string $path
     *
     * @return string
     */
    public function buildPath($path)
    {
        $module = $this->getModuleName();

        return __DIR__.'/'.$module.'/'.$path;
    }

    /**
     * Get the modules name.
     *
     * @return string
     */
    public function getModuleName()
    {
        $fileName = (new ReflectionClass(get_class($this)))->getFileName();

        return str_replace('ServiceProvider', '', basename($fileName, '.php'));
    }
}

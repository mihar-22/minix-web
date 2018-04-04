<?php

namespace Minix\Auth\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;
use Minix\Modules\ModuleBooter;

class AuthServiceProvider extends ServiceProvider
{
    use ModuleBooter;

    public function boot()
    {
        $this->bootModlule();

        $this->registerPolicies();
        $this->registerLaravelPassport();
    }

    public function register()
    {
        Passport::ignoreMigrations();
    }

    public function registerLaravelPassport()
    {
        Passport::routes(function ($router) {
            $router->forAccessTokens();
            $router->forTransientTokens();
        });

        $tokenExpiration = config('auth.passport.tokens.access.expire');
        $refreshExpiration = config('auth.passport.tokens.refresh.expire');

        Passport::tokensExpireIn(now()->addMinutes($tokenExpiration));
        Passport::refreshTokensExpireIn(now()->addMinutes($refreshExpiration));
    }
}

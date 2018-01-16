<?php


namespace Minix\Exchange\Providers;

use Illuminate\Support\ServiceProvider;
use Minix\Modules\ModuleBooter;

class ExchangeServiceProvider extends ServiceProvider
{
    use ModuleBooter;

    public function boot()
    {
        $this->bootModlule();
    }
}
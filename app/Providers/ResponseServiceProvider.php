<?php

namespace Minix\Providers;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;
use Minix\Http\Errors\Error;

class ResponseServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->registerErrorMacro();
    }

    public function registerErrorMacro()
    {
        Response::macro('error', function ($id, $message = null, $hint = null, $errors = null) {
            return response()->json(new Error(
                $id,
                $message,
                $hint,
                $errors
            ));
        });
    }
}

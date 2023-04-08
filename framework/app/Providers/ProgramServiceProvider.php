<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\Programs\ProgramService;

class ProgramServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(ProgramService::class, function ($app) {
            return new ProgramService();
        });
    }
}

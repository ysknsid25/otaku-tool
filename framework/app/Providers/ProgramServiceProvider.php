<?php

namespace App\Providers;

use App\Services\Programs\ProgramService;
use Illuminate\Support\ServiceProvider;

class ProgramServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(ProgramService::class, function ($app) {
            return new ProgramService();
        });
    }
}

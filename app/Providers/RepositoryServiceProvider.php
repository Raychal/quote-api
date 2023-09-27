<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        // Register Interface and Repository in here
        // You must place Interface in first place
        // If you dont, the Repository will not get readed.

        $this->app->bind(
            'App\Interfaces\AuthInterface',
            'App\Repositories\AuthRepository'
        );

        $this->app->bind(
            'App\Interfaces\TypeInterface',
            'App\Repositories\TypeRepository'
        );

        $this->app->bind(
            'App\Interfaces\QuoteInterface',
            'App\Repositories\QuoteRepository'
        );
    }
}

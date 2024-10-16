<?php

namespace Agenciafmd\Icons\Providers;

use Agenciafmd\Icons\Commands\CacheCommand;
use Illuminate\Support\ServiceProvider;

class CommandServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        if (!$this->app->runningInConsole()) {
            return;
        }

        $this->commands([
            CacheCommand::class,
        ]);
    }
}

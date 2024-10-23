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
            // TODO: create a clear command
        ]);

        if (method_exists($this, 'optimizes')) {
            $this->optimizes(
                'admix:icons-cache',
                'cache:clear', // TODO: create a clear command
                'admix-icons'
            );
        }
    }
}

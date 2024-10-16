<?php

namespace Agenciafmd\Icons\Providers;

use Illuminate\Support\ServiceProvider;

class IconServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->bootProviders();
        $this->publish();
    }

    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../../config/admix-icons.php', 'admix-icons');
    }

    public function bootProviders(): void
    {
        $this->app->register(BladeServiceProvider::class);
        $this->app->register(CommandServiceProvider::class);
    }

    private function publish(): void
    {
        $this->publishes([
            __DIR__ . '/../../config/admix-icons.php' => base_path('config/admix-icons.php'),
        ], ['admix-icons:config']);
    }
}

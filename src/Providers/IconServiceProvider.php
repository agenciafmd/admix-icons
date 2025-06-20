<?php

namespace Agenciafmd\Icons\Providers;

use Illuminate\Support\ServiceProvider;

class IconServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->bootProviders();
        $this->bootPublish();
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

    private function bootPublish(): void
    {
        $this->publishes([
            __DIR__ . '/../../resources/bootstrap-icons' => public_path('vendor/admix-ui/vendor/libs/bootstrap-icons'),
        ], ['admix-ui:assets']);

        $this->publishes([
            __DIR__ . '/../../config/admix-icons.php' => base_path('config/admix-icons.php'),
        ], ['admix-icons:config']);
    }
}

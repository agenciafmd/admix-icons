<?php

namespace Agenciafmd\Icons\Providers;

use Agenciafmd\Icons\View\Components\Icon;
use Agenciafmd\Ui\View\Components;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class BladeServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->bootBladeComponents();
        $this->bootBladeDirectives();
        $this->bootViews();
        $this->bootComponents();
    }

    public function bootBladeComponents(): void
    {
        collect(config('admix-icons.sets'))->each(function ($set) {
            Blade::component($set['prefix'] . '-icon', Icon::class);
        });
    }

    public function bootBladeDirectives(): void
    {
        //
    }

    public function bootViews(): void
    {
        //
    }

    public function bootComponents(): void
    {
        //
    }
}

<?php

namespace Agenciafmd\Icons\View\Components;

use Agenciafmd\Icons\Factory\Icon as IconFactory;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Icon extends Component
{
    public function __construct(
        public string $name = '',
        public string $svgPaths = '',
        public array $svgAttributes = [],
    ) {
    }

    public function render(): string|View
    {
        $prefix = str($this->componentName)
            ->beforeLast('-icon')
            ->__toString();

        $icon = (new IconFactory())->name($this->name)
            ->prefix($prefix)
            ->make();
        $this->svgAttributes = $icon->attributes();
        $this->svgPaths = $icon->paths();

        return <<<'HTML'
                <svg {{ $attributes->merge($svgAttributes) }}>
                    {!! $svgPaths !!}
                </svg>
            HTML;
    }
}

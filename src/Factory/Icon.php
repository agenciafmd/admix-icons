<?php

namespace Agenciafmd\Icons\Factory;

use Illuminate\Support\Facades\Cache;

class Icon
{
    private string $svg = '';

    public function __construct(
        public string $name = '',
        public string $prefix = '',
    ) {
    }

    public function name(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function prefix(string $prefix): self
    {
        $this->prefix = $prefix;

        return $this;
    }

    public function render(): string
    {
        return $this->svg;
    }

    public function make(): self
    {
        $path = $this->sourcePath($this->prefix);
        $icon = $this->name;
        $key = 'icon-' . $icon . '-' . str($path)
                ->afterLast('/')
                ->__toString();

        $this->svg = Cache::rememberForever($key, static function () use ($path, $icon) {
            $svg = @file_get_contents($path . '/' . $icon . '.svg');
            if (!$svg) {
                $svg = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                            <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
                        </svg>';
            }

            return str($svg)
                ->squish()
                ->replace('> <', '><')
                ->__toString();
        });

        return $this;
    }

    public function attributes(): array
    {
        return str($this->svg)
            ->after('<svg')
            ->before('>')
            ->trim()
            ->explode('" ')
            ->filter()
            ->mapWithKeys(function ($item) {
                $attributes = str($item)
                    ->explode('="')
                    ->filter()
                    ->toArray();

                $attributes[1] = str($attributes[1])
                    ->trim('"')
                    ->__toString();

                return [$attributes[0] => $attributes[1]];
            })
            ->toArray();
    }

    public function paths(): string
    {
        return str($this->svg)
            ->after('>')
            ->beforeLast('</svg>')
            ->__toString();
    }

    private function sourcePath(string $prefix): string
    {
        return base_path(collect(config('admix-icons.sets'))->firstWhere('prefix', $prefix)['path']);
    }
}
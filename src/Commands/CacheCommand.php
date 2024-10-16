<?php

namespace Agenciafmd\Icons\Commands;

use Agenciafmd\Icons\Factory\Icon as IconFactory;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class CacheCommand extends Command
{
    protected $signature = 'admix:icons-cache';

    protected $description = 'Gera o cache dos ícones';

    public function handle(): int
    {
        $icons = [];
        collect(config('admix-icons.sets'))
            ->each(function ($set) use (&$icons) {
                $prefix = $set['prefix'];
                $path = $set['path'];

                $files = File::allFiles($path);
                collect($files)
                    ->filter(function ($file) {
                        return $file->getExtension() === 'svg';
                    })
                    ->map(function ($file) {
                        return str($file->getFilename())
                            ->beforeLast('.svg')
                            ->__toString();
                    })
                    ->each(function ($icon) use ($prefix, &$icons) {
                        $icons[] = [
                            'name' => $icon,
                            'prefix' => $prefix,
                        ];
                    });
            });
        $icons = collect($icons);

        $this->components->info('Cacheando os ícones');
        $bar = $this->output->createProgressBar($icons->count());
        $icons->each(function ($icon) use ($bar) {
            (new IconFactory())->name($icon['name'])
                ->prefix($icon['prefix'])
                ->make();

            $bar->advance();
        });
        $bar->finish();
        $this->line('');

        $this->components->info('Ícones cacheados com sucesso.');

        return static::SUCCESS;
    }
}

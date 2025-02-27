<?php

declare(strict_types=1);

namespace Codeat3\BladePixelArtIcons;

use BladeUI\Icons\Factory;
use Illuminate\Contracts\Container\Container;
use Illuminate\Support\ServiceProvider;

final class BladePixelArtIconsServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->registerConfig();

        $this->callAfterResolving(Factory::class, function (Factory $factory, Container $container) {
            $config = $container->make('config')->get('blade-pixelarticons', []);

            $factory->add('pixelarticons', array_merge(['path' => __DIR__ . '/../resources/svg'], $config));
        });
    }

    private function registerConfig(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/blade-pixelarticons.php', 'blade-pixelarticons');
    }

    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../resources/svg' => public_path('vendor/blade-pixelarticons'),
            ], 'blade-pixelarticons');

            $this->publishes([
                __DIR__ . '/../config/blade-pixelarticons.php' => $this->app->configPath('blade-pixelarticons.php'),
            ], 'blade-pixelarticons-config');
        }
    }
}

<?php

declare(strict_types=1);

namespace Codeat3\BladePixelArtIcons;

use BladeUI\Icons\Factory;
use Illuminate\Support\ServiceProvider;

final class BladePixelArtIconsServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->callAfterResolving(Factory::class, function (Factory $factory) {
            $factory->add('pixelarticons', [
                'path' => __DIR__.'/../resources/svg',
                'prefix' => 'pixelarticons',
            ]);
        });
    }

    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../resources/svg' => public_path('vendor/blade-pixelarticons'),
            ], 'blade-pixelarticons');
        }
    }
}

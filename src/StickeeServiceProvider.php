<?php namespace Stickee\LaravelCodeStyle;

use Illuminate\Support\ServiceProvider;

class StickeeServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $configPath = __DIR__ . '/../configs/';
        $resourcesPath = __DIR__ . '/../resources/';

        $this->publishes([$configPath => base_path()], 'stickee-configs');
        $this->publishes([$resourcesPath => resource_path()], 'stickee-resources');
    }
}

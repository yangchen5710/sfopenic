<?php

namespace Ycstar\Sfopenic;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    protected $defer = true;
    
    /**
     * Setup the config.
     */
    protected function setupConfig()
    {
        $source = realpath(__DIR__.'/config.php');

        $this->publishes([$source => config_path('sfopenic.php')], 'ycstar-sfopenic');
       
        $this->mergeConfigFrom($source, 'sfopenic');
    }


    public function register()
    {   
        $this->setupConfig();

        $this->app->singleton(Sfopenic::class, function(){
            return new Sfopenic(config('sfopenic.host'),config('sfopenic.dev_id'),config('sfopenic.dev_key'));
        });

        $this->app->alias(Sfopenic::class, 'sfopenic');
    }

    public function provides()
    {
        return [Sfopenic::class, 'sfopenic'];
    }
}
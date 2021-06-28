<?php

namespace Ycstar\Sfopenic;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    protected $defer = true;

    public function register()
    {
        $this->app->singleton(Sfopenic::class, function(){
            return new Sfopenic(config('services.sfopenic.host'),config('services.sfopenic.dev_id'),config('services.sfopenic.dev_key'));
        });

        $this->app->alias(Sfopenic::class, 'sfopenic');
    }

    public function provides()
    {
        return [Sfopenic::class, 'sfopenic'];
    }
}
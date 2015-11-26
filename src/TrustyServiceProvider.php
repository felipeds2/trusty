<?php

namespace Felipeds2\Trusty;

use Illuminate\Support\ServiceProvider;

class TrustyServiceProvider extends ServiceProvider
{
	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;
	
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
    	$this->publishes([
    		__DIR__ . '/src/migrations/' => base_path('/database/migrations'),
    		__DIR__ . '/../config/trusty.php' => config_path('trusty.php'),
    	]);
    	
    	$this->mergeConfigFrom(__DIR__ . '/../config/trusty.php', 'trusty');
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerTrusty();
    }
    
    private function registerTrusty()
    {
        // 
    }
}
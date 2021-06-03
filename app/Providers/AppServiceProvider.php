<?php

namespace App\Providers;

use Elasticsearch\ClientBuilder;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
	    $this->app->singleton('es',function (){
	    	$builder = ClientBuilder::create()->setHosts(config("scout.elasticsearch.hosts"));
	    	$builder->setLogger(app('log')->driver());
	    	return $builder->build();
	    });
    }
}

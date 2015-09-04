<?php namespace GW2Heroes\Providers;

use GW2Treasures\GW2Api\GW2Api;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot() {
		//
	}

	/**
	 * Register any application services.
	 *
	 * This service provider is a great spot to register your various container
	 * bindings with the application.
	 *
	 * @return void
	 */
	public function register() {
		$this->app->singleton('gw2api', function() {
			return new GW2Api();
		});
	}

}

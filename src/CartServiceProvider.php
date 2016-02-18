<?php namespace JetCMS\Cart;

use JetCMS\Core\CoreServiceProvider;

class CartServiceProvider extends CoreServiceProvider {

	/**
	 * Define Service Providers from our dependencies
	 */
	protected $parent_providers = [];

	/**
	 * Define aliases to register
	 */
	protected $aliases = [];

	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->loadViewsFrom(__DIR__.'/../views', 'jetcms.cart');

		$this->publishConfig(__DIR__,'cart');

		$this->publishes([
			__DIR__.'/../publish' => base_path()
		]);

		include __DIR__.'/../routes.php';
	}

}
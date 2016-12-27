<?php

namespace PMU\Providers;

use Illuminate\Support\ServiceProvider;
use DB;
use Event;

class AppServiceProvider extends ServiceProvider {
	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot() {
		if (env ( 'DB_QUERY_DEBUG' )) {
			DB::connection ()->enableQueryLog ();
		}
		if (env ( 'DB_QUERY_DEBUG' )) {
			Event::listen ( 'kernel.handled', function ($request, $response) {
				if ($request->has ( 'sql-debug' )) {
					$queries = DB::getQueryLog ();
					dd ( $queries );
				}
			} );
		}
	}
	
	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register() {
		//
	}
}

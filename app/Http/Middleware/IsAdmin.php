<?php

namespace PMU\Http\Middleware;

use Closure;

class IsAdmin {
	/**
	 * Handle an incoming request.
	 *
	 * @param \Illuminate\Http\Request $request        	
	 * @param \Closure $next        	
	 * @return mixed
	 */
	public function handle($request, Closure $next) {
		if (session ( 'role' ) === 'super_admin' or session ( 'role' ) === 'admin') {
			return $next ( $request );
		}
		
		return redirect ( '/' );
	}
}

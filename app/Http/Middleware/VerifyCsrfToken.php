<?php

namespace PMU\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier {
	/**
	 * The URIs that should be excluded from CSRF verification.
	 *
	 * @var array
	 */
	protected $except = [ 
			'/admin/datatable-users',
			'/admin/datatable-topics',
			'/admin/datatable-topics-by-level',
			'/admin/datatable-articles',
			'/admin/dtable-articles-by-type',
			'/image',
			'/api/password/email' 
	];
}

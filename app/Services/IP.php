<?php

namespace PMU\Services;

use Illuminate\Http\Request;

class IP {
	/**
	 *
	 * @var Request
	 */
	protected $request;
	
	/**
	 * IP constructor.
	 *
	 * @param Request $request        	
	 */
	public function __construct(Request $request) {
		$this->request = $request;
	}
	
	/**
	 * Get the client ip.
	 *
	 * @return mixed|string
	 */
	public function get($integerFormat = true) {
		$ip = $this->request->getClientIp ();
		
		if ($ip == '::1') {
			$ip = '127.0.0.1';
		}
		return $integerFormat ? ip2long ( $ip ) : $ip;
	}
}

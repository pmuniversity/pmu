<?php

namespace PMU\Services;

class Status {
	/**
	 * Set the login user status.
	 *
	 * @param Illuminate\Auth\Events\Login $login        	
	 *
	 * @return void
	 */
	public static function setLoginStatus($login) {
		session ( [ 
				'role' => $login->user->getStatus () 
		] );
	}
	
	/**
	 * Set the visitor user status.
	 *
	 * @return void
	 */
	public static function setVisitorStatus() {
		session ( [ 
				'role' => 'visitor' 
		] );
	}
	
	/**
	 * Set the status.
	 *
	 * @return void
	 */
	public static function setStatus() {
		if (! session ()->has ( 'role' )) {
			session ( [ 
					'role' => auth ()->check () ? auth ()->user ()->getStatus () : 'visitor' 
			] );
		}
	}
}

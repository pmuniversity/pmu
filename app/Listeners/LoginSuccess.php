<?php

namespace PMU\Listeners;

use PMU\Services\Status;
use Illuminate\Auth\Events\Login;

class LoginSuccess {
	/**
	 * Handle the event.
	 *
	 * @param Login $login        	
	 *
	 * @return void
	 */
	public function handle(Login $login) {
		Status::setLoginStatus ( $login );
	}
}

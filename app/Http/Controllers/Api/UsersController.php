<?php

namespace PMU\Http\Controllers\Api;

use Illuminate\Http\Request;
use PMU\Traits\ApiControllerTrait;
use PMU\Http\Controllers\Controller;
use Illuminate\Database\ {
	QueryException
};
use PMU\Repositories\UserRepository;
use PMU\Notifications\ConfirmEmail;
use PMU\Models\User;

class UsersController extends Controller {
	use ApiControllerTrait;
	/**
	 * Illuminate\Http\Request.
	 *
	 * @var request
	 */
	protected $request;
	
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct(Request $request) {
		$this->request = $request;
	}
	/**
	 * Store a newly created resource in storage.
	 *
	 * @param \Illuminate\Http\Request $request        	
	 * @return \Illuminate\Http\Response
	 */
	public function store(UserRepository $userRepository) {
		try {
			$this->validate ( $this->request, [ 
					'email' => 'required|email|unique:users,email' 
			] );
			$user = $userRepository->store ( array_merge($this->request->all (), ['roleId' => 3, 'roleTitle' => 'user']), str_random ( 30 ) );
			if (env ( 'EMAIL_ENABLED' )) {
				$this->notifyUser ( $user );
			}
			if ($this->request->ajax ())
				return $this->respondCreated ( 'Success' );
			
			return 'Subscribe';
		} catch ( QueryException $e ) {
			return $this->respondServerError ( 'Some thing went wrong' . $e->getMessage () );
		}
	}
	
	/**
	 * Notify user with email
	 *
	 * @param \App\Models\User $user        	
	 * @return void
	 */
	protected function notifyUser(User $user) {
		$user->notify ( new ConfirmEmail ( $user->activation_code ) );
	}
}

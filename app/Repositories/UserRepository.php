<?php

namespace PMU\Repositories;

use PMU\Models\ {
	Role, 
	User
};
use Carbon;

class UserRepository extends BaseRepository {
	/**
	 * The Role instance.
	 *
	 * @var PMU\Models\Role
	 */
	protected $role;
	
	/**
	 * Create a new UserRepository instance.
	 *
	 * @param PMU\Models\User $user        	
	 * @param PMU\Models\Role $role        	
	 *
	 * @return void
	 */
	public function __construct(User $user, Role $role) {
		$this->model = $user;
		$this->role = $role;
	}
	
	/**
	 * Save the User.
	 *
	 * @param PMU\Models\User $user        	
	 * @param array $inputs        	
	 *
	 * @return void
	 */
	private function save($user, $inputs) {
		$user->email = $inputs ['email'];
		
		$user->activation_code = str_random ( 30 );
		$user->news_letter_subscribed = 1;
		$user->sign_up_ip = getUserIp ();
		$user->role_id = $inputs ['roleId'] ?? 3;
		$user->role_title = $inputs ['roleTitle'] ?? 'user';
		
		$user->save ();
		return $user;
	}
	
	/**
	 * Create a user.
	 *
	 * @param array $inputs        	
	 * @param int $confirmation_code        	
	 *
	 * @return PMU\Models\User
	 */
	public function store($inputs, $activationCode = null) {
		$user = new $this->model ();
		
		return $this->save ( $user, $inputs );
	}
	
	/**
	 * Update a user.
	 *
	 * @param array $inputs        	
	 * @param PMU\Models\User $user        	
	 *
	 * @return void
	 */
	public function update($inputs, $user) {
		$user->confirmed = isset ( $inputs ['confirmed'] );
		
		$this->save ( $user, $inputs );
	}
	
	/**
	 * Confirm a user.
	 *
	 * @param string $activationCode        	
	 *
	 * @return PMU\Models\User
	 */
	public function confirm($activationCode) {
		$user = $this->model->whereActivationCode ( $activationCode )->firstOrFail ();
		$user->activation_code = null;
		$user->activated_at = Carbon::now ();
		$user->save ();
	}
}

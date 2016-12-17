<?php

namespace PMU\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use PMU\Notifications\ConfirmEmail as ConfirmEmailNotification;

class User extends Authenticatable {
	use Notifiable;
	
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';
	
	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = [ 
			'password',
			'remember_token' 
	];
	
	/**
	 * Validation rules to store an user.
	 *
	 * @var array
	 */
	public static $loginAdminRules = [ 
			'user.email' => 'required|exists:users,email',
			'user.password' => 'required',
			'user.memory' => 'sometimes|boolean' 
	];
	
	/**
	 * One to Many relation.
	 *
	 * @return Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function role() {
		return $this->belongsTo ( env ( 'APP_MODEL_NAMESPACE' ) . 'Role' );
	}
	
	/**
	 * One to Many relation.
	 *
	 * @return Illuminate\Database\Eloquent\Relations\hasMany
	 */
	public function topics() {
		return $this->hasMany ( env ( 'APP_MODEL_NAMESPACE' ) . 'Topic' );
	}
	
	/**
	 * Get user status.
	 *
	 * @return string
	 */
	public function getStatus() {
		return $this->role->slug;
	}
	/**
	 * Get user role.
	 *
	 * @return string
	 */
	public function getRole() {
		return $this->role->slug;
	}
	
	/**
	 * Check media all access.
	 *
	 * @return bool
	 */
	public function accessMediasAll() {
		return $this->getStatus () === 'super_admin' or $this->getStatus () === 'admin';
	}
	
	/**
	 * Check api all access.
	 *
	 * @return bool
	 */
	public function accessApisAll() {
		return $this->getStatus () === 'super_admin' or $this->getStatus () === 'admin';
	}
	
	/**
	 * Check media access one folder.
	 *
	 * @return bool
	 */
	public function accessMediasFolder() {
		return $this->getStatus () != 'user';
	}
	
	/**
	 * Send the email verification notification.
	 *
	 * @param string $activationCode        	
	 * @return void
	 */
	public function sendConfirmEmailNotification($activationCode) {
		$this->notify ( new ConfirmEmailNotification ( $activationCode ) );
	}
}

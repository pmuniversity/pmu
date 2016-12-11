<?php

namespace PMU\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ConfirmEmail extends Notification {
	use Queueable;
	/**
	 * The password reset token.
	 *
	 * @var string
	 */
	public $activationCode;
	
	/**
	 * Create a new notification instance.
	 *
	 * @return void
	 */
	public function __construct($activationCode) {
		$this->activationCode = $activationCode;
	}
	
	/**
	 * Get the notification's delivery channels.
	 *
	 * @param mixed $notifiable        	
	 * @return array
	 */
	public function via($notifiable) {
		return [ 
				'mail' 
		];
	}
	
	/**
	 * Get the mail representation of the notification.
	 *
	 * @param mixed $notifiable        	
	 * @return \Illuminate\Notifications\Messages\MailMessage
	 */
	public function toMail($notifiable) {
		return (new MailMessage ())->subject ( trans ( 'front/verify.email-title' ) )->line ( trans ( 'front/verify.email-title' ) )->line ( trans ( 'front/verify.email-intro' ) )->action ( trans ( 'front/verify.email-button' ), url ( 'confirm/' . $this->activationCode ) );
	}
	
	/**
	 * Get the array representation of the notification.
	 *
	 * @param mixed $notifiable        	
	 * @return array
	 */
	public function toArray($notifiable) {
		return [ ];
		//
		
	}
}

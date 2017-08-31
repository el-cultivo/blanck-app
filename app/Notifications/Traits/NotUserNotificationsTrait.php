<?php

namespace App\Notifications\Traits;

use App\Models\Settings\Setting;
use App\User;

use Notification;

trait NotUserNotificationsTrait {

	public static function NotUserNotify(array $emails)
	{
		foreach ($emails as $args) {
			$notify = (new User([
				"email"	=> $args["email"]
			]));
			$notify->notify( new static( $args ));
		}
	}
}

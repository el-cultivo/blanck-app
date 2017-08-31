<?php

namespace App\Notifications\Traits;

use App\Models\Settings\Setting;
use App\Models\Users\User;

use Notification;

trait NotUserNotificationsTrait {

	public static function NotUsersNotify(array $emails)
	{
		foreach ($emails as $args) {
			static::SingleNotUserNotify($args);
		}
	}

	public static function NotUserNotify(array $args)
	{
		$notify = (new User([
			"email"	=> $args["email"]
		]));
		$notify->notify( new static( $args ));
	}
}

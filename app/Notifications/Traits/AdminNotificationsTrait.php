<?php

namespace App\Notifications\Traits;

use App\Models\Settings\Setting;
use App\Models\Users\User;

use Notification;

trait AdminNotificationsTrait {

	public static function AdminNotify(array $admin_users,array $args)
	{

		if (!empty($admin_users)) {
			Notification::send(collect($admin_users),  new static( $args ) );
		}else{
			static::SystemNotify($args);
		}

	}

	public static function SystemNotify(array $args)
	{
		$notify_user = new User([
			"email"	=> Setting::getEmail('notifications')
		]);
		$notify_user->notify( new static( $args ));
	}


}

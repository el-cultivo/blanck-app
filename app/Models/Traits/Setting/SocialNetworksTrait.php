<?php namespace App\Models\Traits\Setting;

trait SocialNetworksTrait {

	/**
	* Get the Social Networks Link
	*
	* @return array[] with urls,
	*/
	public static function getSocialNetworks()
	{
		return self::getSetting('social')->value;
	}

	public static function getSpecificSocialNetwork( $sn_name )
	{
		return array_get(self::getSocialNetworks(), $sn_name);
	}

}

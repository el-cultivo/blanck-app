<?php namespace App\Models\Traits\Setting;

trait MailsTrait {

	/**
    * Get the Mail values
    *
    * @return array[] with urls,
    */
    public static function getMail()
    {
        return self::getSetting('mail')->value;
    }

    /**
    * Get the a specific mail
    *
    * @return string with email,
    */
    public static function getEmail($key):string
    {
        $mail = self::getMail();
        if (!$mail || !array_has($mail,$key) ) {
            return config( "mail.from.address");
        }
        return $mail[$key];
    }

    /**
    * Get the a specific line of a mail content for a language
    *
    * @return string with email,
    */
    public static function getEmailLine($key,$iso = null ):string
    {
        $iso = is_null($iso) ? cltvoCurrentLanguageIso() : $iso;

       $mail = self::getMail();
        if (!$mail || !array_has($mail, $key.'.'.$iso) ) {
            return '';
        }
        return $mail[$key][$iso];
    }

    /**
    * Get the a specific copy of a mail content for a language
    *
    * @return string with email,
    */
    public static function getEmailCopy($key, $iso = null):string
    {
        return static::getEmailLine($key.'_copy',$iso);
    }

    /**
    * Get the a general mail content greeting for a language
    *
    * @return string with email,
    */
    public static function getEmailGreeting($iso = null):string
    {
        return static::getEmailLine('mail_greeting',$iso);
    }

    /**
    * Get the a general mail content farewell for a language
    *
    * @return string with email,
    */
    public static function getEmailFarewell($iso = null):string
    {
        return static::getEmailLine('mail_farewell',$iso);
    }
	
}

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
    public static function getEmail($key, $mail=null):string
    {
         $mail = $mail ? $mail :self::getMail();
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
    public static function getEmailLine($key,$iso = null, $mail=null ):string
    {
        $iso = is_null($iso) ? cltvoCurrentLanguageIso() : $iso;

       $mail = $mail ? $mail :self::getMail();
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
    public static function getEmailCopy($key, $iso = null, $mail=null):string
    {
        return static::getEmailLine($key.'_copy',$iso, $mail);
    }

    /**
    * Get the a general mail content greeting for a language
    *
    * @return string with email,
    */
    public static function getEmailGreeting($iso = null, $mail=null):string
    {
        return static::getEmailLine('mail_greeting',$iso, $mail);
    }

    /**
    * Get the a general mail content farewell for a language
    *
    * @return string with email,
    */
    public static function getEmailFarewell($iso = null, $mail=null):string
    {
        return static::getEmailLine('mail_farewell',$iso, $mail);
    }

}

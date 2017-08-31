<?php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

use App\Models\Settings\Setting;


abstract class CltvoNotification extends Notification
{
    use Queueable;

    protected $from_email;
    protected $from_name;

    protected $mail_greeting;
    protected $mail_farawell;

    protected $email_view = 'vendor.notifications.email';

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->from_name 		= config( "mail.from.name");
        $this->from_email 		= Setting::getEmail('system');
        $this->mail_greeting 	= Setting::getEmailGreeting();
        $this->mail_farawell 	= Setting::getEmailFarewell();
		$this->trasnlation_path	= collect(explode("\\",str_replace(["App\\Notifications\\","Notification"], ["",""], static::class )))->map(function($part){
			return snake_case($part);
		})->implode(".");
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    protected function trans($key,array $args = [])
    {
        return trans('notifications.'.$this->trasnlation_path.'.'.$key ,$args );
    }

}

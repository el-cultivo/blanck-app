<?php

namespace App\Notifications\Client;

use Illuminate\Notifications\Messages\MailMessage;

use App\Notifications\CltvoNotification;

class ResetPasswordNotification extends CltvoNotification
{
    /**
     * The password reset token.
     *
     * @var string
     */
    public $token;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($token)
    {
        parent::__construct();
        $this->token = $token;
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {

        return (new MailMessage)
                    ->from( $this->from_email, $this->from_name )
                    ->success()
                    ->view($this->email_view)
                    ->subject( $this->trans('subject') )
                    ->greeting( $this->mail_greeting )
                    ->line( $this->trans('copy')  )
                    ->action( $this->trans('action') , route('client::pass_reset_token',[$this->token,"email"=>$notifiable->email]) )
                    ->line( $this->mail_farawell );
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}

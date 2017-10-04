<?php

namespace App\Notifications\User;

use App\Notifications\CltvoNotification;
use Illuminate\Notifications\Messages\MailMessage;

class UpdateMailNotification extends CltvoNotification
{
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
                    ->view( $this->email_view )
                    ->subject(  $this->trans('subject') )
                    ->greeting( $this->mail_greeting )
                    ->line( $this->trans('copy')  )
                    ->line( $this->mail_farawell  );
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

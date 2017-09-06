<?php

namespace App\Notifications\Admin\Users;

use Illuminate\Notifications\Messages\MailMessage;

use App\Notifications\CltvoNotification;

class ActivationAccountNotification extends CltvoNotification
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
                    ->success()
                    ->view($this->email_view)
                    ->subject(  $this->trans('subject') )
                    ->greeting(   $this->mail_greeting  )
                    ->line( $this->getSettingCopy("register") )
                    ->action( $this->trans('action'), $notifiable->getActivationAcountUrl() )
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

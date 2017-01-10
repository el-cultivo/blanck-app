<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Setting;

class ThanksForContactMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $name;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('hola@mextropoli.mx', 'Andrea de Mextropoli')
                    ->view('vendor.notifications.email')
                    ->text('vendor.notifications.email-plain')
                    ->subject('Re: Información de contacto mextropoli.mx')
                    ->with([
                        'greeting'   => 'Hola '.$this->name.',',
                        'introLines' => ['Gracias por contactarte con nosotros. Hemos recibido tu correo y muy pronto nos pondremos en contacto contigo.'],
                        'outroLines' => [],
                        'actionText' => 'Ir a mextropoli.mx',
                        'actionUrl'  => url('/'),
                        'level'      => 'success'
                    ]);
    }
}

<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Settings\Setting;

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
        return $this->from('dev@elcultivo.mx', 'Dev El Cultivo')
                    ->view('vendor.notifications.email')
                    ->text('vendor.notifications.email-plain')
                    ->subject('Re: Información de contacto elcultivo.mx')
                    ->with([
                        'greeting'   => 'Hola '.$this->name.',',
                        'introLines' => ['Gracias por contactarte con nosotros. Hemos recibido tu correo y muy pronto nos pondremos en contacto contigo.'],
                        'outroLines' => [],
                        'actionText' => 'Ir a elcultivo.mx',
                        'actionUrl'  => url('/'),
                        'level'      => 'success'
                    ]);
    }
}

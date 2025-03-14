<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CodigoRecuperacionMail extends Mailable
{
    use Queueable, SerializesModels;

    public $codigo;

    /**
     * Crear una nueva instancia del correo.
     *
     * @param int $codigo
     */
    public function __construct($codigo)
    {
        $this->codigo = $codigo;
    }

    /**
     * Construir el correo.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('AMAZONT - RECUPERAR CONTRASEÑA')
                    ->view('emails.codigo-recuperacion')
                    ->with(['codigo' => $this->codigo]);
    }
}

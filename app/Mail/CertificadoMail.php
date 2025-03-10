<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CertificadoMail extends Mailable
{
   use Queueable, SerializesModels;

   public $solicitud_id;
   public $adjuntos;
   public $asunto_correo;
   public $nombre;

   /**
    * Create a new message instance.
    */
   public function __construct($solicitud_id, $nombre, $adjuntos,$asunto_correo)
   {
      $this->solicitud_id = $solicitud_id;
      $this->adjuntos = $adjuntos;
      $this->nombre = $nombre;
      $this->asunto_correo = $asunto_correo;
   }

   public function build()
   {
      // Inicializamos el correo
      $email = $this->subject($this->asunto_correo)
         ->view('emails.certificado')  // Asegúrate de tener una vista de correo
         ->with([
            'solicitud_id' => $this->solicitud_id,
            'nombre_completo' => $this->nombre,
         ]);
         // Adjuntar todos los archivos
         foreach ($this->adjuntos as $archivo) {
            $email->attach(asset($archivo));
         }
         dd($email);
      return $email;
   }
}

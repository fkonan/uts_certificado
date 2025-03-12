<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CertificadoMail extends Mailable implements ShouldQueue
{
   use Queueable, SerializesModels;

   public $solicitud;
   public $adjuntos;
   public $config_correo;
   public $descripcion;
   public $observaciones;

   /**
    * Create a new message instance.
    */
   public function __construct($solicitud, $adjuntos, $config_correo, $observaciones)
   {
      $this->descripcion = $config_correo->descripcion;

      $this->descripcion = str_replace(
         ['$documento', '$nombre_completo', '$id'],
         [$solicitud->documento, $solicitud->nombre_completo, $solicitud->id],
         $this->descripcion
      );
      $this->solicitud = $solicitud;
      $this->adjuntos = $adjuntos;
      $this->config_correo = $config_correo;
      $this->observaciones = $observaciones;
   }

   public function build()
   {
      $this->config_correo->asunto = str_replace(
         ['$documento', '$nombre_completo', '$id'],
         [$this->solicitud->documento, $this->solicitud->nombre_completo, $this->solicitud->id],
         $this->config_correo->asunto
      );
      // Inicializamos el correo
      $email = $this->subject($this->config_correo->asunto)
         ->view('emails.certificado')  // Asegúrate de tener una vista de correo
         ->with([
            'asunto' => $this->config_correo->asunto,
            'config_correo' => $this->config_correo,
            'solicitud' => $this->solicitud,
            'descripcion' => $this->descripcion,
            'observaciones' => $this->observaciones,
         ]);
      // Adjuntar todos los archivos
      foreach ($this->adjuntos as $archivo) {
         // $email->attach(asset($archivo));
         $filePath = storage_path('app/public/' . str_replace('storage/', '', $archivo));
         $email->attach($filePath);
      }
      return $email;
   }
}

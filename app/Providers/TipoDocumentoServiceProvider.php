<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class TipoDocumentoServiceProvider extends ServiceProvider
{
   /**
    * Register services.
    */
   public function register(): void
   {
      $this->app->bind('tipo_documento', function () {
         return [
            // 'RC' => 'Registro civil',
            'TI' => 'Tarjeta de identidad',
            'CC' => 'Cédula de ciudadanía',
            'TE' => 'Tarjeta de extranjería',
            'CE' => 'Cédula de extranjería',
            // 'NIT' => 'Número de identificación tributaria',
            'PP' => 'Pasaporte',
            'PEP' => 'Permiso especial de permanencia',
            'DIE' => 'Documento de identificación extranjero',
            'NUIP' => 'NUIP'
         ];
      });
   }

   /**
    * Bootstrap services.
    */
   public function boot(): void
   {
      //
   }
}

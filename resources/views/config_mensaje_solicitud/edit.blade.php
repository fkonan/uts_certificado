@extends('adminlte::page')

@section('title', 'Editar registro')

@section('content_header')
   <h1>Configuración mensajes de correos</h1>
@stop
@section('content')
   <div class="card">
      <div class="card-header">
         <div class="row">
            <div class="col">
               <h5 class="mb-0">Nuevo registro</h5>
            </div>
            <div class="col text-right">
               <a href="{{ route('config-mensaje-solicitud.index') }}" class="btn btn-primary btn-sm">Listar registros</a>
            </div>
         </div>
      </div>
      <div class="card-body">
         <form action="{{ route('config-mensaje-solicitud.update') }}" method="POST" class="needs-validation" novalidate>
            @csrf
            @method('PUT')
            <input type="hidden" name="id" value="{{ $datos->id }}">
            <div class="row">
               <div class="col-md-12">
                  <p>Utilice las siguientes variables para ser reemplazadas en el momento de elaborar el correo:</p>
                  <ul>
                     <li>
                        <b>$documento</b> = Si quiere que aparezca el número de documento del estudiante.
                     </li>
                     <li>
                        <b>$nombre_completo</b> = Si quiere que aparezca el nombre completo del estudiante.
                     </li>
                     <li>
                        <b>$id</b> = Si quiere que aparezca el número de solicitud.
                     </li>
                     <!-- <li>
                        <b>$codigo</b> = Si quiere que aparezca el código del QR de la solicitud.
                     </li> -->
                  </ul>
               </div>
            </div>
            <div class="row">
               <div class="col-3">
                  <x-adminlte-select name="estado" id="estado" label="Estado de la solicitud" required
                     label-class="text-lightblue">
                     <x-slot name="prependSlot">
                     <div class="input-group-text">
                        <i class="fas fa-id-card text-lightblue"></i>
                     </div>
                     </x-slot>
                     <option value="Pendiente" {{ $datos->estado == 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
                     <option value="En curso" {{ $datos->estado == 'En curso' ? 'selected' : '' }}>En curso</option>
                     <option value="Finalizado" {{ $datos->estado == 'Finalizado' ? 'selected' : '' }}>Finalizado
                     </option>
                     <option value="Cerrado" {{ $datos->estado == 'Cerrado' ? 'selected' : '' }}>Cerrado</option>
                  </x-adminlte-select>
               </div>
               <div class="col-9">
                  <x-adminlte-input type="text" name="asunto" id="asunto" label="Asunto del correo" required
                     placeholder="Ej: Generacion de certificado..." label-class="text-lightblue"
                     value="{{ $datos->asunto }}" enable-old-support>
                     <x-slot name="prependSlot">
                        <div class="input-group-text">
                           <i class="fas fa-dollar-sign text-lightblue"></i>
                        </div>
                     </x-slot>
                  </x-adminlte-input>
               </div>
            </div>
            <div class="row">
               <div class="col-12">
                  <label for="descripcion" class="text-lightblue">Descripción del correo</label>
                  <textarea name="descripcion" id="descripcion" rows="10" cols="80">
                     {!! $datos->descripcion !!}
                  </textarea>
               </div>
            </div>
            <div class="row">
               <div class="col text-right">
                  <x-adminlte-button class="btn-sm" type="submit" label="Guardar" theme="success" />
               </div>
            </div>
      </div>
   @stop
   @section('adminlte_js')
      <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>

      <script>
         const doc = document;
         doc.addEventListener('DOMContentLoaded', function() {
            ClassicEditor
               .create(document.querySelector('#descripcion'), {})
               .catch(error => {
                  console.error(error);
               });
         });
      </script>
   @stop

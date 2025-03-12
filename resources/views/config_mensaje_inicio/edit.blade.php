@extends('adminlte::page')

@section('title', 'Actualizar registro')

@section('content_header')
   <h1>Configuración de mensaje de inicio</h1>
@stop
@section('content')
   <div class="card">
      <div class="card-header">
         <div class="row">
            <div class="col">
               <h5 class="mb-0">Configuración de mensaje de inicio</h5>
            </div>
            <div class="col text-right">
               <a href="{{ route('config-mensaje-inicial.index') }}" class="btn btn-primary btn-sm">Volver</a>
            </div>
         </div>
      </div>
      <div class="card-body">
         <form action="{{ route('config-mensaje-inicial.update') }}" method="POST" class="needs-validation"
            novalidate enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="hidden" name="id" value="{{ $datos->id }}">
            <div class="row">
               <div class="col-4">
                  <x-adminlte-input-file name="banner" id="banner" igroup-size="sm"
                     placeholder="Seleccionar archivo..." label="Banner" label-class="text-lightblue" legend="Cargar"
                     accept=".png,.jpg,.jpeg">
                     <x-slot name="prependSlot">
                        <div class="input-group-text bg-lightblue">
                           <i class="fas fa-upload"></i>
                        </div>
                     </x-slot>
                  </x-adminlte-input-file>
               </div>
               <div class="col-4">
                  <x-adminlte-input type="text" name="titulo_video" label="Titulo que va al lado del video"
                     placeholder="Ej: Este es un video de..." label-class="text-lightblue"
                     value="{{ $datos->titulo_video }}" enable-old-support>
                     <x-slot name="prependSlot">
                        <div class="input-group-text">
                           <i class="fas fa-info-circle text-lightblue"></i>
                        </div>
                     </x-slot>
                  </x-adminlte-input>
               </div>
               <div class="col-4">
                  <x-adminlte-input type="text" name="url_video" label="Url  del video" placeholder="Ej:youtube..."
                     label-class="text-lightblue" value="{{ $datos->url_video }}" enable-old-support>
                     <x-slot name="prependSlot">
                        <div class="input-group-text">
                           <i class="fas fa-info-circle text-lightblue"></i>
                        </div>
                     </x-slot>
                  </x-adminlte-input>
               </div>
            </div>
            <div class="row mb-2">
               <div class="col-12">
                  <label for="texto1" class="text-lightblue">Texto primer recuadro</label>
                  <textarea name="texto1" id="texto1" rows="10" cols="80">
                     {!!$datos->texto1!!}
                  </textarea>
               </div>
            </div>
            <div class="row">
               <div class="col-12">
                 <label for="texto2" class="text-lightblue">Texto segundo recuadro</label>
                  <textarea name="texto2" id="texto2" rows="10" cols="80">
                     {!!$datos->texto2!!}
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
               .create(document.querySelector('#texto1'), {
               })
               .catch(error => {
                  console.error(error);
               });

               ClassicEditor
               .create(document.querySelector('#texto2'), {
               })
               .catch(error => {
                  console.error(error);
               });
         });
      </script>
   @stop

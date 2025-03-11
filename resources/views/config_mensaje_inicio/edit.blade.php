@extends('adminlte::page')

@section('title', 'Actualizar registro')

@section('content_header')
   <h1>Certificados</h1>
@stop
@section('content')
   <div class="card">
      <div class="card-header">
         <div class="row">
            <div class="col">
               <h5 class="mb-0">Actualizar registro</h5>
            </div>
            <div class="col text-right">
               <a href="{{ route('certificados.index') }}" class="btn btn-primary btn-sm">Listar registros</a>
            </div>
         </div>
      </div>
      <div class="card-body">
         <form action="{{ route('certificados.update', $certificado) }}" method="POST" class="needs-validation" novalidate>
            @csrf
            @method('PUT')

            <div class="row">
               <div class="col-4">
                  <x-adminlte-input type="text" name="tipo_certificado" label="Tipo de certificado" required
                     placeholder="Ej: Certificado de notas" label-class="text-lightblue"
                     value="{{ $certificado->tipo_certificado }}" enable-old-support>
                     <x-slot name="prependSlot">
                        <div class="input-group-text">
                           <i class="fas fa-id-card text-lightblue"></i>
                        </div>
                     </x-slot>
                  </x-adminlte-input>
               </div>
               <div class="col-2">
                  <x-adminlte-input type="number" name="valor" label="Valor" required placeholder="Ej: 13000"
                     label-class="text-lightblue" value="{{ $certificado->valor }}" enable-old-support>
                     <x-slot name="prependSlot">
                        <div class="input-group-text">
                           <i class="fas fa-dollar-sign text-lightblue"></i>
                        </div>
                     </x-slot>
                  </x-adminlte-input>
               </div>
               <div class="col-6">
                  <x-adminlte-input type="text" name="mensaje" label="Mensaje adicional para mostrar"
                     placeholder="Ej: Este certificado requiere de..." label-class="text-lightblue"
                     value="{{ $certificado->mensaje }}" enable-old-support>
                     <x-slot name="prependSlot">
                        <div class="input-group-text">
                           <i class="fas fa-info-circle text-lightblue"></i>
                        </div>
                     </x-slot>
                  </x-adminlte-input>
               </div>
            </div>
            <div class="row">
               <div class="col-2">
                  <x-adminlte-select name="estado" label="Estado" label-class="text-lightblue">
                     <option>Seleccione</option>
                     <option {{$certificado->estado?'selected':''}} value="1">Activo</option>
                     <option {{!$certificado->estado?'selected':''}} value="0">Inactivo</option>
                  </x-adminlte-select>
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
      <script>
         const doc = document;
         doc.addEventListener('DOMContentLoaded', function() {

         });
      </script>
   @stop

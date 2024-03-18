@extends('adminlte::page')

@section('title', 'Responder solicitud')

@section('content_header')
   <h1>Solicitud de certificados</h1>
@stop
@section('content')
   <div class="card">
      <div class="card-header">
         <div class="row">
            <div class="col">
               <h5 class="mb-0">Responder solicitud</h5>
            </div>
            <div class="col text-right">
               <a href="{{ route('solicitudes.admin') }}" class="btn btn-primary btn-sm">Listar solicitudes</a>
            </div>
         </div>
      </div>
      <div class="card-body">
         <form action="{{ route('solicitudes.update', $solicitud->id) }}" method="POST" class="needs-validation" novalidate
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
               <div class="col-2">
                  <x-adminlte-select name="estado" label="Estado general de la solicitud" label-class="text-lightblue"
                     required>
                     <option value="">Seleccione</option>
                     <option {{ $solicitud->estado == 'Pendiente' ? 'selected' : '' }} value="Pendiente">Pendiente</option>
                     <option {{ $solicitud->estado == 'En curso' ? 'selected' : '' }} value="En curso">En curso</option>
                     <option {{ $solicitud->estado == 'Finalizado' ? 'selected' : '' }} value="Finalizado">Finalizado
                     </option>
                     <option {{ $solicitud->estado == 'Cerrado' ? 'selected' : '' }} value="Cerrado">Cerrado</option>
                  </x-adminlte-select>
               </div>
               <div class="col-10">
                  <x-adminlte-input type="text" name="observacion_uts"
                     label="Observaciones generales de la solicitud para mostrar al estudiante"
                     placeholder="Ej: Este certificado requiere de..." label-class="text-lightblue"
                     value="{{ $solicitud->observacion_uts }}" enable-old-support>
                     <x-slot name="prependSlot">
                        <div class="input-group-text">
                           <i class="fas fa-info-circle text-lightblue"></i>
                        </div>
                     </x-slot>
                  </x-adminlte-input>
               </div>
            </div>
            <div class="callout callout-warning">
               <h4>Listado de certificados</h4>
               <div class="row">
                  @foreach ($certificados as $item)
                     <input type="hidden" name="certificados[{{ $item->id }}][id]" value="{{ $item->id }}">
                     <div class="col-3 align-self-center border-bottom">
                        <p class="font-weight-bold text-lightblue">
                           @if ($item->pivot->ruta)
                              <a href="{{ asset(Storage::url($item->pivot->ruta)) }}" target="_blank"><i
                                    class="fas fa-file-pdf fa-lg text-danger"></i></a>
                           @else
                              <i class="fas fa-file fa-lg text-muted"></i>
                           @endif

                           {{ $item->tipo_certificado }}
                        </p>
                     </div>
                     <div class="col-2">
                        <x-adminlte-select name="certificados[{{ $item->id }}][estado]" label="Estado del certificado"
                           label-class="text-lightblue" required>
                           <option value="">Seleccione</option>
                           <option {{ $item->pivot->estado == 'Pendiente' ? 'selected' : '' }} value="Pendiente">Pendiente
                           </option>
                           <option {{ $item->pivot->estado == 'En curso' ? 'selected' : '' }} value="En curso">En curso
                           </option>
                           <option {{ $item->pivot->estado == 'Enviado' ? 'selected' : '' }} value="Enviado">Enviado
                           </option>
                           <option {{ $item->pivot->estado == 'Anulado' ? 'selected' : '' }} value="Anulado">Anulado
                           </option>
                        </x-adminlte-select>
                     </div>
                     <div class="col-2">
                        <x-adminlte-input-file name="certificados[{{ $item->id }}][ruta]" igroup-size="sm"
                           placeholder="Seleccionar archivo..." label="Adj. certificado" label-class="text-lightblue"
                           legend="Cargar">
                           <x-slot name="prependSlot">
                              <div class="input-group-text bg-lightblue">
                                 <i class="fas fa-upload"></i>
                              </div>
                           </x-slot>
                        </x-adminlte-input-file>
                     </div>
                     <div class="col-5">
                        <x-adminlte-input type="text" name="certificados[{{ $item->id }}][observaciones]"
                           label="Observaciones para el certificado" placeholder="Ej: Este certificado requiere de..."
                           label-class="text-lightblue" value="{{ $item->pivot->observaciones }}" enable-old-support>
                           <x-slot name="prependSlot">
                              <div class="input-group-text">
                                 <i class="fas fa-info-circle text-lightblue"></i>
                              </div>
                           </x-slot>
                        </x-adminlte-input>
                     </div>
                  @endforeach
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
         doc.addEventListener('DOMContentLoaded', function() {});
      </script>
   @stop

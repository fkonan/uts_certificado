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
            <a href="{{ route('solicitudes.admin.index') }}" class="btn btn-primary btn-sm">Listar solicitudes</a>
         </div>
      </div>
   </div>
   <div class="card-body">
      <form action="{{ route('solicitudes.update', $solicitud->id) }}" method="POST" class="needs-validation"
         enctype="multipart/form-data" id="frm" novalidate>
         @csrf
         @method('PUT')
         <div class="row">
            <div class="col-2">
               <x-adminlte-select name="estado" label="Estado general de la solicitud" label-class="text-lightblue"
                  id="estado" required>
                  <option value="">Seleccione</option>
                  <option {{ $solicitud->estado == 'Pendiente' ? 'selected' : '' }} value="Pendiente">Pendiente
                  </option>
                  <option {{ $solicitud->estado == 'En curso' ? 'selected' : '' }} value="En curso">En curso
                  </option>
                  <option {{ $solicitud->estado == 'Finalizado' ? 'selected' : '' }} value="Finalizado">Finalizado
                  </option>
                  <option {{ $solicitud->estado == 'Cerrado' ? 'selected' : '' }} value="Cerrado">Cerrado</option>
               </x-adminlte-select>
            </div>
            <div class="col-10">
               <x-adminlte-input type="text" name="observacion_uts"
                  label="Observaciones generales de la solicitud para mostrar al estudiante"
                  placeholder="Ej: Este certificado requiere de..." label-class="text-lightblue"
                  value="{{ $solicitud->observacion_uts }}" id="observacion_uts" enable-old-support>
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
               <input type="hidden" id="certificado-{{ $item->id }}" name="certificados[{{ $item->id }}][id]"
                  value="{{ $item->id }}">
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
               <div class="col-3">
                  <x-adminlte-input-file name="certificados[{{ $item->id }}][ruta]" igroup-size="sm" fgroup-class="mb-0"
                     placeholder="Seleccionar archivo..." label="Adj. certificado" legend="Cargar"
                     onchange="handleFileSelect(this, {{ $item->id }})">
                     <x-slot name="prependSlot">
                        <div class="input-group-text bg-lightblue">
                           <i class="fas fa-upload"></i>
                        </div>
                     </x-slot>
                  </x-adminlte-input-file>
                  <button type="button" class="btn btn-link " data-toggle="modal"
                     data-target="#pdf-modal-{{ $item->id }}">
                     Vista Previa
                  </button>
                  <div class="modal fade" id="pdf-modal-{{ $item->id }}" tabindex="-1" role="dialog"
                     aria-labelledby="pdfModalLabel-{{ $item->id }}" aria-hidden="true">
                     <div class="modal-dialog modal-xl" role="document">
                        <div class="modal-content">
                           <div class="modal-header">
                              <h5 class="modal-title" id="pdfModalLabel-{{ $item->id }}">Vista Previa del Certificado
                              </h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                 <span aria-hidden="true">&times;</span>
                              </button>
                           </div>
                           <div class="modal-body">
                              <iframe id="pdf-preview-{{ $item->id }}"
                                 style="width: 100%; height: 700px; border: none;"></iframe>
                           </div>
                           <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               @endforeach
            </div>
         </div>
         <div class="row">
            <div class="col text-right">
               <x-adminlte-button class="btn-sm" type="submit" label="Guardar" theme="success" />
            </div>
         </div>
      </form>
   </div>
</div>

@stop
@section('js')
<script>
   const doc = document;
   doc.addEventListener('DOMContentLoaded', function () {
      const estadoSelect = doc.getElementById('estado');
      const fileInputs = doc.querySelectorAll('input[type="file"]');

      estadoSelect.addEventListener('change', function() {
      if (estadoSelect.value === 'Finalizado') {
      fileInputs.forEach(input => input.setAttribute('required', 'required'));
      } else {
      fileInputs.forEach(input => input.removeAttribute('required'));
      }
      });
   });

   doc.getElementById('frm').addEventListener('submit', function (event) {

      // Mostrar un cuadro de diálogo de confirmación
      var confirmed = confirm('¿Está seguro de guardar la información?');

      // Si el usuario cancela, evitar el envío del formulario
      if (!confirmed) {
         event.preventDefault(); // Previene el envío del formulario
      }
   });

   function handleFileSelect(input, itemId) {
      var file = input.files[0];
      if (file && file.type === "application/pdf") {
         var reader = new FileReader();
         reader.onload = function (e) {
            var iframe = document.getElementById('pdf-preview-' + itemId);
            iframe.src = e.target.result;
         };
         reader.readAsDataURL(file);
      } else {
         // Limpiar el iframe si el archivo no es un PDF
         var iframe = document.getElementById('pdf-preview-' + itemId);
         iframe.src = '';
      }
   }
</script>
@stop
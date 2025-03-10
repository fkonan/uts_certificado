@extends('adminlte::page') @section('title', 'Responder solicitud')
@section('content_header')
   <h1>Solicitud de certificados</h1>
   @stop @section('content')
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
         <div class="row">
            <div class="col-md-3">
               <p class="mb-1">
                  <strong>Documento:</strong> {{ $solicitud->tipo_documento }} -
                  {{ $solicitud->documento }}
               </p>
               <p class="mb-1">
                  <strong>Nombre:</strong> {{ $solicitud->nombre_completo }}
               </p>
               <p class="mb-1">
                  <strong>Teléfono:</strong> {{ $solicitud->telefono }}
               </p>
            </div>
            <div class="col-md-3">
               <p class="mb-1"><strong>Correo:</strong> {{ $solicitud->correo }}</p>
               <p class="mb-1">
                  <strong>Es egresado:</strong>
                  {{ $solicitud->egresado ? 'SI' : 'NO' }}
               </p>
               <p class="mb-1">
                  <strong>Teléfono:</strong> {{ $solicitud->telefono }}
               </p>
            </div>
            <div class="col-md-3">
               <p class="mb-1"><strong>Certificados solicitados:</strong></p>
               <ul>
                  @foreach ($certificados as $item)
                     <li>
                        {{ $item->tipo_certificado }}
                     </li>
                  @endforeach
               </ul>
            </div>
            <div class="col-md-3">
               <p class="mb-1">
                  <strong>Fecha de la solicitud:</strong>
                  {{ $solicitud->created_at }}
               </p>
               <p class="mb-0"><strong>Adjuntos:</strong></p>
               <ul>
                  <li>
                     <a href="{{ asset('storage') }}/{{ $solicitud->adj_documento }}" target="_blank">
                        Documento
                     </a>
                  </li>
                  <li>
                     <a href="{{ asset('storage') }}/{{ $solicitud->adj_estampilla }}" target="_blank">
                        Estampilla
                     </a>
                  </li>
                  <li>
                     <a href="{{ asset('storage') }}/{{ $solicitud->adj_pago }}" target="_blank">
                        Pago
                     </a>
                  </li>
               </ul>
            </div>
         </div>
         <hr />
         <form action="{{ route('solicitudes.update', $solicitud->id) }}" method="POST" class="needs-validation"
            enctype="multipart/form-data" id="frm" novalidate>
            @csrf @method('PUT')
            <div class="row">
               <div class="col-2">
                  <x-adminlte-select name="estado" label="Estado general de la solicitud" label-class="text-lightblue"
                     id="estado" required>
                     <option value="">Seleccione</option>
                     <option {{ $solicitud->estado == 'Pendiente' ? 'selected' : '' }} value="Pendiente">Pendiente
                     </option>
                     <option {{ $solicitud->estado == 'En curso' ? 'selected' : '' }}
                        value="En
                     curso">En curso
                     </option>
                     <option {{ $solicitud->estado == 'Finalizado' ? 'selected' : '' }} value="Finalizado">Finalizado
                     </option>
                     <option {{ $solicitud->estado == 'Cerrado' ? 'selected' : '' }} value="Cerrado">Cerrado
                     </option>
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
            <div class="row" id="divSolAdjuntos">
               <div class="col-md-12">
                  <h4 class="mt-3">
                     Si necesita solicitar algún adjunto al estudiante de nuevo,
                     deje la solicitud en estado pendiente y cambie la opcion a
                     'SI' en el documento que desea solicitar de nuevo.
                  </h4>
               </div>
               <div class="col-md-4">
                  <x-adminlte-select name="edit_adj_documento" label="Solicitar documento de identidad"
                     label-class="text-lightblue" id="edit_adj_documento" required>
                     <option value="">Seleccione</option>
                     <option {{ $solicitud->edit_adj_documento == '1' ? 'selected' : '' }} value="1">Si
                     </option>
                     <option {{ $solicitud->edit_adj_documento == '0' ? 'selected' : '' }} value="0">No
                     </option>
                  </x-adminlte-select>
               </div>
               <div class="col-md-4">
                  <x-adminlte-select name="edit_adj_estampilla" label="Solicitar estampilla" label-class="text-lightblue"
                     id="edit_adj_estampilla" required>
                     <option value="">Seleccione</option>
                     <option {{ $solicitud->edit_adj_estampilla == '1' ? 'selected' : '' }} value="1">Si
                     </option>
                     <option {{ $solicitud->edit_adj_estampilla == '0' ? 'selected' : '' }} value="0">No
                     </option>
                  </x-adminlte-select>
               </div>
               <div class="col-md-4">
                  <x-adminlte-select name="edit_adj_pago" label="Solicitar pago" label-class="text-lightblue"
                     id="edit_adj_pago" required>
                     <option value="">Seleccione</option>
                     <option {{ $solicitud->edit_adj_pago == '1' ? 'selected' : '' }} value="1">Si
                     </option>
                     <option {{ $solicitud->edit_adj_pago == '0' ? 'selected' : '' }} value="0">No
                     </option>
                  </x-adminlte-select>
               </div>
            </div>
            <div class="callout callout-warning d-none" id="divCertificados">
               <h4>Listado de certificados</h4>
               <div class="row">
                  @foreach ($certificados as $item)
                     <input type="hidden" id="certificado-{{ $item->id }}"
                        name="certificados[{{ $item->id }}][id]" value="{{ $item->id }}" />

                     <div class="col-3 align-self-center border-bottom mx-3">
                        <p class="font-weight-bold text-lightblue">
                           @if ($item->pivot->ruta)
                              <a href="/storage/{{ $item->pivot->ruta }}" target="_blank"><i
                                    class="fas fa-file-pdf fa-lg text-danger"></i>Descargar certificado con Qr</a>
                           @else
                              <i class="fas fa-file fa-lg text-muted"></i>
                           @endif

                           {{ $item->tipo_certificado }}
                        </p>
                     </div>

                     <div class="col-3">
                        <x-adminlte-input-file name="certificados[{{ $item->id }}][ruta]" igroup-size="sm"
                           fgroup-class="mb-0" placeholder="Seleccionar archivo..." label="Adj. certificado"
                           legend="Cargar" onchange="handleFileSelect(this, {{ $item->id }})">
                           <x-slot name="prependSlot">
                              <div class="input-group-text bg-lightblue">
                                 <i class="fas fa-upload"></i>
                              </div>
                           </x-slot>
                        </x-adminlte-input-file>
                     </div>

                     <div class="col-3 mt-3">
                        <button type="button" class="btn btn-link pt-3" data-toggle="modal"
                           data-target="#pdf-modal-{{ $item->id }}">
                           <-- Vista Previa del certificado cargado </button>
                              <div class="modal fade" id="pdf-modal-{{ $item->id }}" tabindex="-1" role="dialog"
                                 aria-labelledby="pdfModalLabel-{{ $item->id }}" aria-hidden="true">
                                 <div class="modal-dialog modal-xl" role="document">
                                    <div class="modal-content">
                                       <div class="modal-header">
                                          <h5 class="modal-title" id="pdfModalLabel-{{ $item->id }}">
                                             Vista Previa del Certificado
                                          </h5>
                                          <button type="button" class="close" data-dismiss="modal"
                                             aria-label="Close">
                                             <span aria-hidden="true">&times;</span>
                                          </button>
                                       </div>
                                       <div class="modal-body">
                                          <iframe id="pdf-preview-{{ $item->id }}"
                                             style="
                                    width: 100%;
                                    height: 700px;
                                    border: none;
                                 "></iframe>
                                       </div>
                                       <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                             Cerrar
                                          </button>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                     </div>
                  @endforeach
               </div>
               <div class="row">
                  <h4>Detalle del asunto del correo</h4>
                  <div class="col-12">
                     <x-adminlte-input type="text" name="asunto_correo" id="asunto_correo" label="Asunto del correo"
                        placeholder="Ej: Certificado de egresado" label-class="text-lightblue">
                        <x-slot name="prependSlot">
                           <div class="input-group-text">
                              <i class="fas fa-info-circle text-lightblue"></i>
                           </div>
                        </x-slot>
                     </x-adminlte-input>
                  </div>
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

   @stop @section('js')
   <script>
      const doc = document;
      doc.addEventListener("DOMContentLoaded", function() {
         const estadoSelect = doc.getElementById("estado");
         const fileInputs = doc.querySelectorAll('input[type="file"]');
         const asunto_correo = doc.getElementById("asunto_correo");
         estadoSelect.dispatchEvent(new Event("change"));
         estadoSelect.addEventListener("change", function() {
            if (estadoSelect.value === "Finalizado") {
               fileInputs.forEach((input) =>
                  input.setAttribute("required", "required")
               );
               asunto_correo.setAttribute("required", "required");
            } else {
               fileInputs.forEach((input) => input.removeAttribute("required"));
               asunto_correo.removeAttribute("required");
            }
         });
      });

      doc.getElementById("estado").addEventListener("change", function() {
         const divCertificados = doc.getElementById("divCertificados");
         const divSolAdjuntos = doc.getElementById("divSolAdjuntos");
         if (this.value === "Finalizado") {
            divCertificados.classList.remove("d-none");
            divSolAdjuntos.classList.add("d-none");
            doc.getElementById("observacion_uts").value = "";
         } else {
            divCertificados.classList.add("d-none");
            divSolAdjuntos.classList.remove("d-none");
         }
      });

      doc.getElementById("frm").addEventListener("submit", function(event) {
         // Mostrar un cuadro de diálogo de confirmación
         var confirmed = confirm("¿Está seguro de guardar la información?");

         // Si el usuario cancela, evitar el envío del formulario
         if (!confirmed) {
            event.preventDefault(); // Previene el envío del formulario
         }
      });

      function handleFileSelect(input, itemId) {
         var file = input.files[0];
         if (file && file.type === "application/pdf") {
            var reader = new FileReader();
            reader.onload = function(e) {
               var iframe = document.getElementById("pdf-preview-" + itemId);
               iframe.src = e.target.result;
            };
            reader.readAsDataURL(file);
         } else {
            // Limpiar el iframe si el archivo no es un PDF
            var iframe = document.getElementById("pdf-preview-" + itemId);
            iframe.src = "";
         }
      }
   </script>
@stop

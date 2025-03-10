@extends('adminlte::page') @section('title', 'Solicitudes manuales')
@section('content_header')
   <h1>Solicitudes de Certificados Manuales</h1>
   @stop @section('content')
   <div class="card">
      <div class="card-header">
         <div class="col">
            <h5 class="mb-0">Registro de nueva solicitud (manual)</h5>
         </div>
      </div>
      <div class="card-body">
         <form action="{{ route('solicitud.manual.store') }}" method="POST" class="needs-validation" id="frm"
            enctype="multipart/form-data" novalidate>
            @csrf

            <div class="callout callout-success">
               <h5 class="font-weight-bold">Datos del estudiante</h5>
               <div class="row">
                  <div class="col-2">
                     <x-adminlte-select name="tipo_documento" id="tipo_documento" label="Tipo de Documento *"
                        label-class="text-lightblue" enable-old-support required>
                        <option value="">Seleccionar</option>
                        @foreach (app('tipo_documento') as $key => $value)
                           <option value="{{ $key }}" {{ old('tipo_documento') == $key ? 'selected' : '' }}>
                              {{ $value }}
                           </option>
                        @endforeach
                     </x-adminlte-select>
                  </div>
                  <div class="col-2">
                     <x-adminlte-input type="text" name="documento" label="Documento *" placeholder="Ej: 1098999999"
                        label-class="text-lightblue" enable-old-support required>
                        <x-slot name="prependSlot">
                           <div class="input-group-text">
                              <i class="fas fa-id-card text-lightblue"></i>
                           </div>
                        </x-slot>
                     </x-adminlte-input>
                  </div>
                  <div class="col-4">
                     <x-adminlte-input type="text" name="nombre_completo" label="Nombre completo *"
                        placeholder="Ej: Pepito Perez Gomez" label-class="text-lightblue" enable-old-support required>
                        <x-slot name="prependSlot">
                           <div class="input-group-text">
                              <i class="fas fa-user text-lightblue"></i>
                           </div>
                        </x-slot>
                     </x-adminlte-input>
                  </div>
                  <div class="col-2">
                     <x-adminlte-input type="text" name="telefono" label="Teléfono" placeholder="Ej: 312999999"
                        label-class="text-lightblue" enable-old-support>
                        <x-slot name="prependSlot">
                           <div class="input-group-text">
                              <i class="fas fa-mobile-alt text-lightblue"></i>
                           </div>
                        </x-slot>
                     </x-adminlte-input>
                  </div>
                  <div class="col-2 align-self-center">
                     <div class="form-group">
                        <label class="text-lightblue mr-2">Es graduado?</label><br />
                        <div class="icheck-primary form-check form-check-inline">
                           <input type="radio" name="egresado" id="si" value="1" />
                           <label for="si" class="form-check-label">Si</label>
                        </div>
                        <div class="icheck-primary form-check form-check-inline">
                           <input type="radio" name="egresado" id="no" value="0" checked />
                           <label for="no" class="form-check-label">No</label>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-4">
                     <x-adminlte-input type="email" name="correo" label="Correo electrónico *"
                        placeholder="Ej: correo@example.com" label-class="text-lightblue" enable-old-support required>
                        <x-slot name="prependSlot">
                           <div class="input-group-text">
                              <i class="fas fa-envelope text-lightblue"></i>
                           </div>
                        </x-slot>
                     </x-adminlte-input>
                     <p class="text-lightblue">
                        <b>Recuerde:</b> El correo electrónico que está ingresando
                        en este campo, es con el que tendremos contacto con usted y
                        al cual enviaremos el certificado una vez generado.
                     </p>
                  </div>
                  <div class="col-8">
                     <x-adminlte-textarea name="observaciones" label="Observaciones sobre la solicitud"
                        placeholder="Ej: Carrera, semestre, etc; información específica  sobre el certificado que desea solicitar. "
                        label-class="text-lightblue" enable-old-support rows="3">
                        <x-slot name="prependSlot">
                           <div class="input-group-text">
                              <i class="fas fa-comment text-lightblue"></i>
                           </div>
                        </x-slot>
                     </x-adminlte-textarea>
                  </div>
               </div>
            </div>

            <div class="callout callout-warning">
               <h5 class="font-weight-bold">Datos del certificado y pago</h5>
               <div class="row">
                  <div class="col-12">
                     @php $config = ['placeholder' => 'Selecciona uno o varios certificados.', 'allowClear' => true, 'theme' => 'bootstrap4']; @endphp
                     <x-adminlte-select2 id="tipo_certificado" name="tipo_certificado[]"
                        label="Selecciona uno o varios certificados *" label-class="text-lightblue" fgroup-class="mb-0"
                        multiple required :config="$config">
                        @foreach ($certificados as $certificado)
                           <option value="{{ $certificado['id'] }}" data-mensaje="{{ $certificado['mensaje'] }}">
                              {{ $certificado['tipo_certificado'] }}
                           </option>
                        @endforeach
                        <x-slot name="appendSlot">
                           <div class="input-group-text bg-lightblue">
                              <i class="far fa-file-alt"></i>
                           </div>
                        </x-slot>
                     </x-adminlte-select2>
                  </div>
                  <div class="col-3 mt-3" id="file-inputs-container">

                  </div>
               </div>
            </div>
            <div class="row justify-content-end">
               <div class="col-auto">
                  <button type="submit" class="btn btn-success">
                     Enviar solicitud
                  </button>
               </div>
            </div>
         </form>
      </div>
   </div>
   @stop @section('js')
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
   <script>
      $(document).ready(function() {
         $('#tipo_certificado').on('change', function() {
            var selectedCertificates = $(this).val();
            var fileInputsContainer = $('#file-inputs-container');
            fileInputsContainer.empty();

            selectedCertificates.forEach(function(certificado) {
               var inputFile = `
                     <div class="form-group">
                        <label for="file_${certificado}" class="text-lightblue">Adjuntar archivo</label>
                        <input type="file" name="file_${certificado}" id="file_${certificado}" class="form-control" required>
                     </div>
                  `;
               fileInputsContainer.append(inputFile);
            });
         });
      });
   </script>
@stop

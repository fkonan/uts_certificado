@extends('adminlte::page')

@section('title', 'Solicitudes')

@section('content_header')
<h1>Solicitudes de Certificados</h1>
@stop

@section('content')
<div class="card">
   <div class="card-header">
      <div class="col">
         <h5 class="mb-0">Registro de nueva solicitud</h5>
      </div>
      <div class="col text-right">
         <a href="{{ route('solicitudes.index') }}" class="btn btn-primary btn-sm">Ver mis solicitudes</a>
      </div>
   </div>
   <div class="card-body">
      <form action="{{ route('solicitudes.store') }}" method="POST" class="needs-validation"
         enctype="multipart/form-data" novalidate>
         @csrf

         <div class="callout callout-success">
            <h5 class="font-weight-bold">
               Datos del estudiante
            </h5>
            <div class="row">
               <div class="col-2">
                  <x-adminlte-select name="tipo_documento" label="Tipo de documento *" label-class="text-lightblue">
                     <x-adminlte-options :options="app('tipo_documento')" empty-option="Seleccione"
                        placeholder="Seleccione" required />
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
                  <x-adminlte-input type="text" name="telefono" label="Teléfono *" placeholder="Ej: 312999999"
                     label-class="text-lightblue" enable-old-support required>
                     <x-slot name="prependSlot">
                        <div class="input-group-text">
                           <i class="fas fa-mobile-alt text-lightblue"></i>
                        </div>
                     </x-slot>
                  </x-adminlte-input>
               </div>
               <div class="col-2 align-self-center">
                  <div class="form-group">
                     <label class="text-lightblue mr-2">Es egresado?</label><br>
                     <div class="icheck-primary form-check form-check-inline">
                        <input type="radio" name="egresado" id="si" value="1">
                        <label for="si" class="form-check-label">Si</label>
                     </div>
                     <div class="icheck-primary form-check form-check-inline">
                        <input type="radio" name="egresado" id="no" value="0" checked>
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
                  <p class="text-lightblue"><b>Recuerde:</b> El correo electrónico que está ingresando en este
                     campo, es
                     con el que tendremos contacto con usted y al cual enviaremos el certificado una vez
                     generado.</p>
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
            <h5 class="font-weight-bold">
               Datos del certificado y pago
            </h5>
            <div class="row">
               <div class="col-12">
                  @php
                  $config = [
                  'placeholder' => 'Selecciona uno o varios certificados.',
                  'allowClear' => true,
                  'theme' => 'bootstrap4',
                  ];
                  @endphp
                  <x-adminlte-select2 id="tipo_certificado" name="tipo_certificado[]"
                     label="Selecciona uno o varios certificados *" label-class="text-lightblue" fgroup-class="mb-0" multiple required
                     :config="$config">
                     @foreach ($certificados as $certificado)
                     <option value="{{ $certificado['id'] }}" data-mensaje="{{ $certificado['mensaje'] }}">
                        {{ $certificado['tipo_certificado'] }}</option>
                     @endforeach
                     <x-slot name="appendSlot">
                        <div class="input-group-text bg-lightblue">
                           <i class="far fa-file-alt"></i>
                        </div>
                     </x-slot>
                  </x-adminlte-select2>
                  <p class="text-info">Si solicita varios certificados, debe adjuntar en un
                     <b>único pdf,</b> todos pagos pecuniarios realizados en el campo: <b>"Adj. recibo de
                        pago
                        UTS"</b>.
                  </p>
               </div>
            </div>
            <div class="row mt-3">
               <div class="col-4">
                  <x-adminlte-input-file name="adj_documento" igroup-size="sm" placeholder="Seleccionar archivo..."
                     label="Adj. documento de identidad" label-class="text-lightblue" legend="Cargar" required>
                     <x-slot name="prependSlot">
                        <div class="input-group-text bg-lightblue">
                           <i class="fas fa-upload"></i>
                        </div>
                     </x-slot>
                  </x-adminlte-input-file>
               </div>
               <div class="col-4">
                  <x-adminlte-input-file name="adj_estampilla" igroup-size="sm" placeholder="Seleccionar archivo..."
                     label="Adj. estampilla" label-class="text-lightblue" legend="Cargar" required>
                     <x-slot name="prependSlot">
                        <div class="input-group-text bg-lightblue">
                           <i class="fas fa-upload"></i>
                        </div>
                     </x-slot>
                  </x-adminlte-input-file>
               </div>
               <div class="col-4">
                  <x-adminlte-input-file name="adj_pago" igroup-size="sm" placeholder="Seleccionar archivo..."
                     label="Adj. recibo de pago UTS" label-class="text-lightblue" legend="Cargar" required>
                     <x-slot name="prependSlot">
                        <div class="input-group-text bg-lightblue">
                           <i class="fas fa-upload"></i>
                        </div>
                     </x-slot>
                  </x-adminlte-input-file>
               </div>
            </div>
         </div>
         <div class="row justify-content-end">
            <div class="col-auto">
               <button type="submit" class="btn btn-success">Enviar solicitud</button>
            </div>
         </div>
      </form>
   </div>
</div>
@stop
@section('js')
<script>
   $('#tipo_certificado').on('select2:select', function(e) {
         let mensaje = $(e.params.data.element).data('mensaje');
      });
</script>
@stop

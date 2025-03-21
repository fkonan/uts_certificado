@extends('adminlte::page') @section('title', 'Solicitudes')
@section('content_header')
<h1>Solicitudes de Certificados</h1>
@stop @section('content')
<div class="card">
   <div class="card-header">
      <div class="col">
         <h5 class="mb-0">Registro de nueva solicitud</h5>
      </div>
      <div class="col text-right">
         <a
            href="{{ route('solicitudes.index') }}"
            class="btn btn-primary btn-sm"
            >Ver mis solicitudes</a
         >
      </div>
   </div>
   <div class="card-body">
      <form
         action="{{ route('solicitudes.store') }}"
         method="POST"
         class="needs-validation"
         id="frm"
         enctype="multipart/form-data"
         novalidate
      >
         @csrf

         <div class="callout callout-success">
            <h5 class="font-weight-bold">Datos del estudiante</h5>
            <div class="row">
               <div class="col-2">
                  <input
                     type="hidden"
                     name="tipo_documento"
                     value="{{$usuario->tipo_documento}}"
                  />
                  <x-adminlte-input
                     type="text"
                     name="tipo_documento_mostrar"
                     label="Tipo de documento *"
                     value="{{$usuario->tipo_documento}}"
                     label-class="text-lightblue"
                     enable-old-support
                     required
                     readOnly
                  >
                     <x-slot name="prependSlot">
                        <div class="input-group-text">
                           <i class="fas fa-id-card text-lightblue"></i>
                        </div>
                     </x-slot>
                  </x-adminlte-input>
               </div>
               <div class="col-2">
                  <x-adminlte-input
                     type="text"
                     name="documento"
                     label="Documento *"
                     placeholder="Ej: 1098999999"
                     value="{{$usuario->documento}}"
                     label-class="text-lightblue"
                     enable-old-support
                     required
                     readOnly
                  >
                     <x-slot name="prependSlot">
                        <div class="input-group-text">
                           <i class="fas fa-id-card text-lightblue"></i>
                        </div>
                     </x-slot>
                  </x-adminlte-input>
               </div>
               <div class="col-4">
                  <x-adminlte-input
                     type="text"
                     name="nombre_completo"
                     label="Nombre completo *"
                     value="{{$usuario->name}}"
                     placeholder="Ej: Pepito Perez Gomez"
                     label-class="text-lightblue"
                     enable-old-support
                     required
                     readOnly
                  >
                     <x-slot name="prependSlot">
                        <div class="input-group-text">
                           <i class="fas fa-user text-lightblue"></i>
                        </div>
                     </x-slot>
                  </x-adminlte-input>
               </div>
               <div class="col-2">
                  <x-adminlte-input
                     type="text"
                     name="telefono"
                     label="Teléfono *"
                     placeholder="Ej: 312999999"
                     value="{{$usuario->telefono}}"
                     label-class="text-lightblue"
                     enable-old-support
                     readOnly
                  >
                     <x-slot name="prependSlot">
                        <div class="input-group-text">
                           <i class="fas fa-mobile-alt text-lightblue"></i>
                        </div>
                     </x-slot>
                  </x-adminlte-input>
               </div>
               <div class="col-2 align-self-center">
                  <div class="form-group">
                     <label class="text-lightblue mr-2">Es graduado?</label
                     ><br />
                     <div class="icheck-primary form-check form-check-inline">
                        <input type="radio" name="egresado" id="si" value="1" />
                        <label for="si" class="form-check-label">Si</label>
                     </div>
                     <div class="icheck-primary form-check form-check-inline">
                        <input
                           type="radio"
                           name="egresado"
                           id="no"
                           value="0"
                           checked
                        />
                        <label for="no" class="form-check-label">No</label>
                     </div>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-4">
                  <x-adminlte-input
                     type="email"
                     name="correo"
                     label="Correo electrónico *"
                     value="{{$usuario->email}}"
                     placeholder="Ej: correo@example.com"
                     label-class="text-lightblue"
                     enable-old-support
                     required
                     readOnly
                  >
                     <x-slot name="prependSlot">
                        <div class="input-group-text">
                           <i class="fas fa-envelope text-lightblue"></i>
                        </div>
                     </x-slot>
                  </x-adminlte-input>
                  <p class="text-lightblue">
                     <b>Recuerde:</b> El correo electrónico registrado aquí,
                     es con el que tendremos contacto con usted y al cual enviaremos el certificado una vez generado.
                     Si desea actualziarlo vaya a la opción "Perfil".
                  </p>
               </div>
               <div class="col-8">
                  <x-adminlte-textarea
                     name="observaciones"
                     label="Observaciones sobre la solicitud"
                     placeholder="Ej: Carrera, semestre, etc; información específica  sobre el certificado que desea solicitar. "
                     label-class="text-lightblue"
                     enable-old-support
                     rows="3"
                  >
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
                  @php $config = [ 'placeholder' => 'Selecciona uno o varios certificados.', 'allowClear' => true, 'theme' => 'bootstrap4',
                  ]; @endphp
                  <x-adminlte-select2
                     id="tipo_certificado"
                     name="tipo_certificado[]"
                     label="Selecciona uno o varios certificados *"
                     label-class="text-lightblue"
                     fgroup-class="mb-0"
                     multiple
                     required
                     :config="$config"
                  >
                     @foreach ($certificados as $certificado)
                     <option
                        value="{{ $certificado['id'] }}"
                        data-mensaje="{{ $certificado['mensaje'] }}"
                     >
                        {{ $certificado["tipo_certificado"] }}
                     </option>
                     @endforeach
                     <x-slot name="appendSlot">
                        <div class="input-group-text bg-lightblue">
                           <i class="far fa-file-alt"></i>
                        </div>
                     </x-slot>
                  </x-adminlte-select2>
                  <p class="text-info">
                     Si solicita varios certificados, debe adjuntar en un
                     <b>único pdf,</b> todos pagos pecuniarios realizados en el
                     campo: <b>"Adj. recibo de pago UTS"</b>.
                  </p>
               </div>
            </div>
            <div class="row mt-3">
               <div class="col-4">
                  <x-adminlte-input-file
                     name="adj_documento"
                     id="adj_documento"
                     igroup-size="sm"
                     placeholder="Seleccionar archivo..."
                     label="Adj. documento de identidad"
                     label-class="text-lightblue"
                     legend="Cargar"
                     required
                     accept=".pdf"
                  >
                     <x-slot name="prependSlot">
                        <div class="input-group-text bg-lightblue">
                           <i class="fas fa-upload"></i>
                        </div>
                     </x-slot>
                  </x-adminlte-input-file>
               </div>
               <div class="col-4">
                  <x-adminlte-input-file
                     name="adj_estampilla"
                     id="adj_estampilla"
                     igroup-size="sm"
                     placeholder="Seleccionar archivo..."
                     label="Adj. estampilla"
                     label-class="text-lightblue"
                     legend="Cargar"
                     required
                     accept=".pdf"
                  >
                     <x-slot name="prependSlot">
                        <div class="input-group-text bg-lightblue">
                           <i class="fas fa-upload"></i>
                        </div>
                     </x-slot>
                  </x-adminlte-input-file>
               </div>
               <div class="col-4">
                  <x-adminlte-input-file
                     name="adj_pago"
                     id="adj_pago"
                     igroup-size="sm"
                     placeholder="Seleccionar archivo..."
                     label="Adj. recibo de pago UTS"
                     label-class="text-lightblue"
                     legend="Cargar"
                     required
                     accept=".pdf"
                  >
                     <x-slot name="prependSlot">
                        <div class="input-group-text bg-lightblue">
                           <i class="fas fa-upload"></i>
                        </div>
                     </x-slot>
                  </x-adminlte-input-file>
               </div>

               <div class="col-12">
                  <p class="text-info">
                     <b>Nota:</b> Todos los documentos adjuntos, deben ir en
                     formato pdf y con un tamaño maximo de 2Mb.
                  </p>
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
   const arr_mensajes = [];

   $("#tipo_certificado").on("select2:select", function (e) {
      let mensaje = $(e.params.data.element).data("mensaje");

      if (!arr_mensajes.includes(mensaje)) {
         arr_mensajes.push(mensaje);
      }
   });

   $("#tipo_certificado").on("select2:unselect", function (e) {
      // Obtener el "mensaje" del ítem deseleccionado
      let mensaje = $(e.params.data.element).data("mensaje");

      // Eliminar del array
      const index = arr_mensajes.indexOf(mensaje);
      if (index !== -1) {
         arr_mensajes.splice(index, 1); // Eliminar el ítem del array
      }
   });

   $("#frm").on("submit", function (e) {
      e.preventDefault(); // Evita que el formulario se envíe de inmediato

      if (arr_mensajes.length > 0) {
         // Crear un mensaje con los elementos del array
         let mensajesHtml =
            "<ul>" +
            arr_mensajes.map((mensaje) => `<li>${mensaje}</li>`).join("") +
            "</ul>";

         // Mostrar SweetAlert con el mensaje de confirmación
         Swal.fire({
            title: "Validación de información",
            // text: 'Antes de continuar con la solicitud tenga en cuenta lo siguiente: ' + mensajes,
            html: `<p>Antes de continuar con la solicitud tenga en cuenta lo siguiente:</p>${mensajesHtml}`, // Usamos 'html' en lugar de 'text'
            icon: "warning",
            showCancelButton: true, // Muestra el botón de Cancelar
            confirmButtonText: "Sí, enviar solicitud",
            cancelButtonText: "No, cancelar",
            reverseButtons: true, // Invierte el orden de los botones (Sí a la izquierda)
         }).then((result) => {
            if (result.isConfirmed) {
               // Si el usuario hace clic en "Sí, enviar", proceder con el submit
               this.submit(); // Envía el formulario
            } else {
               // Si el usuario hace clic en "No, cancelar", no hacer nada
               console.log("El envío ha sido cancelado.");
            }
         });
      } else {
         // Si el array está vacío, puedes proceder normalmente con el submit
         this.submit(); // Envía el formulario si el array está vacío
      }
   });

   var fileInputs = document.querySelectorAll(
      "#adj_documento, #adj_estampilla, #adj_pago"
   );
   var maxSize = 2.4 * 1024 * 1024; // 2.4MB

   adj_documento;
   adj_estampilla;
   adj_pago;

   fileInputs.forEach(function (input) {
      input.addEventListener("change", function (event) {
         // Obtener el archivo seleccionado
         var file = event.target.files[0];

         // Verificar si hay un archivo
         if (file) {
            // Comprobar el tamaño del archivo
            if (file.size > maxSize) {
                  Swal.fire({
                    icon: 'error',
                    title: 'Archivo demasiado grande',
                    text: 'El archivo ' + file.name + ' excede el tamaño máximo permitido de 2.5MB.',
                  });
               // Limpiar el campo de archivo
               event.target.value = "";
            }
         }
      });
   });
</script>
@stop

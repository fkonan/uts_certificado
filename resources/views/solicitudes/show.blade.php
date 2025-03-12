@extends('layouts.guest') @section('title', 'Certificados')
@section('adminlte_css')
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" />
   <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.22.3/dist/bootstrap-table.min.css" />
   @stop @section('body')
   <div class="row" id="divValidar">
      <div class="col-md-12">
         <div class="form-group">
            <input type="text" class="form-control" id="codigo" name="codigo" placeholder="Código del certificado" />
            <button class="btn btn-primary mt-2" id="btnValidar" data-codigo="{{ $datos->first()->certificados->first()->pivot->codigo }}">
               Validar
            </button>
         </div>
      </div>
   </div>

   <div class="card d-none" id="divCard">
      <div class="card-header">
         <div class="row">
            <div class="col">
               <h5 class="mb-0">Datos del certificado consultado</h5>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-md-3"></div>
      </div>
      <div class="card-body" id="divCertificado">
         <table id="table" class="table table-sm table-hover" data-search="true">
            <thead>
               <tr class="bg-success">
                  <th data-sortable="true" data-field="datos.certificados.tipo_certificado">
                     Nombre del certificado
                  </th>
                  <th data-field="documento">Documento del estudiante/egresado</th>
                  <th data-field="nombre_completo">
                     Nombre del estudiante/egresado
                  </th>
                  <th data-field="updated_at">
                     Fecha de generación del certificado
                  </th>
                  <th data-field="ruta">Certificado</th>
               </tr>
            </thead>
            <tbody>
               @foreach ($datos as $item)
                  @foreach ($item->certificados as $certificado)
                     <tr>
                        <td>{{ $certificado->tipo_certificado }}</td>
                        <td>{{ $item->documento }}</td>
                        <td>{{ $item->nombre_completo }}</td>
                        <td>{{ $certificado->updated_at }}</td>
                        <td>
                           @if ($certificado->pivot->ruta)
                              <a href=" {{ asset('storage') . '/' . $certificado->pivot->ruta }}" target="_blank"><i
                                    class="fas fa-file-pdf fa-lg text-danger"></i>
                                 Descargar
                              </a>
                           @else
                              <i class="fas fa-file fa-lg text-muted"></i>
                           @endif
                        </td>
                     </tr>
                  @endforeach
               @endforeach
            </tbody>
         </table>
      </div>
   </div>
   @stop @section('adminlte_js')
   <script src="https://unpkg.com/bootstrap-table@1.22.3/dist/bootstrap-table.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

   <script>
      $(document).ready(function() {
         $("#btnValidar").click(function() {
            let dataCodigo = $(this).data("codigo");
            let codigo = $("#codigo").val();
            if (dataCodigo == codigo) {
               document.getElementById("divCard").classList.remove("d-none");
               document.getElementById("divValidar").classList.add("d-none");
            } else {
               Swal.fire({
                  icon: "error",
                  title: "Código incorrecto",
                  text: "El código no es correcto, por favor revisa tu certificado debajo del QR.",
               });

               document.getElementById("divCard").classList.add("d-none");
               document.getElementById("divValidar").classList.remove("d-none");
               return;
            }
         });
      });
   </script>
@stop

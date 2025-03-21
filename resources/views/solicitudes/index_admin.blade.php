@extends('adminlte::page')

@section('title', 'Listado de Solicitudes')

@section('adminlte_css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
<link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.22.3/dist/bootstrap-table.min.css">
@stop

@section('content_header')
<h1>Solicitudes Pendientes</h1>
@stop
@section('content')
<div class="card">
   <div class="card-header">
      <div class="row">
         <div class="col">
            <h5 class="mb-0">Listado de solicitudes pendientes</h5>
         </div>
      </div>
   </div>
   <div class="card-body ">
      <table id="table" class="table table-sm small" data-search="true">
         <thead>
            <tr class="bg-success">
               <th data-field="acciones" data-formatter="acciones">Acciones</th>
               <th data-sortable="true" data-field="id">#</th>
               <th data-sortable="true" data-field="estado">Estado</th>
               <th data-sortable="true" data-field="user_uts.name">Usuario</th>
               <th data-sortable="true" data-field="documento">Documento</th>
               <th data-sortable="true" data-field="nombre_completo">Estudiante</th>
               <th data-sortable="true" data-field="telefono">Teléfono</th>
               <th data-sortable="true" data-field="correo">Correo electrónico</th>
               <th data-field="adj_documento" data-formatter="adjuntos">Adj. documento</th>
               <th data-field="adj_estampilla" data-formatter="adjuntos">Adj. estampilla</th>
               <th data-field="adj_pago" data-formatter="adjuntos">Adj pago</th>
               <th data-field="certificados.tipo_certificado" data-formatter="certificados">Certificados solicitados
               </th>
               <th data-sortable="true" data-field="updated_at">Fecha de la solicitud</th>
            </tr>
         </thead>
      </table>
   </div>
</div>
@stop

@section('adminlte_js')
<script src="https://unpkg.com/bootstrap-table@1.22.3/dist/bootstrap-table.min.js"></script>
<script>
   let estado=`{{$estado}}`;
   const doc = document;
      doc.addEventListener('DOMContentLoaded', function() {
         let table = doc.getElementById('table');

         $.ajaxSetup({
         headers: {
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
         });

         $('#table').bootstrapTable({
            url: `/solicitudes/admin/data`,
            //url: `/solicitudes/admin/data`,
            method: 'GET',
            ajaxOptions: {
               headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               }
            },
            formatNoMatches: function() {
               return 'No se encontraron registros';
            },
            formatSearch: function() {
               return 'Buscar...';
            },

            onLoadSuccess: function(data, status, jqXHR) {
               let forms = doc.querySelectorAll('.frm');
               forms.forEach(form => {
                  form.addEventListener('submit', function(event) {
                     event.preventDefault();
                     const formElement = this;
                     Swal.fire({
                        title: "¿Desea eliminar este registro?",
                        text: "Esta acción no se puede deshacer",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#d33",
                        cancelButtonColor: "#3085d6",
                        confirmButtonText: "Sí, eliminar"
                     }).then((result) => {
                        if (result.isConfirmed) {
                           formElement.submit();

                        }
                     });
                  });
               });
            }
         });
      });

      function certificados(value, row, index, field) {
         const certificados = row.certificados.map(certificado => `<li>${certificado.tipo_certificado}</li>`);
         return `<ul class="px-3 mb-1">${certificados.join('')}</ul>`;
      }

      function adjuntos(value, row, index, field) {

         if (field == 'adj_documento' || field == 'adj_estampilla' || field == 'adj_pago') {
            return `<div class="text-center"><a class="btn btn-danger" href="{{asset('storage')}}/${value}" target="_blank"><i class="fas fa-file-pdf"></i></a></div>`;

         }

         return `<ul>${certificados.join('')}</ul>`;
      }

      function egresado(value, row, index, field) {
         return value ? 'Sí' : 'No';
      }

      function acciones(value, row, index, field) {
         return `<a href="/solicitudes/${row.id}/edit" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>`;
      }
</script>
@stop

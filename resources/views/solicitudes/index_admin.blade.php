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
         <table id="table" class="table table-sm" data-search="true">
            <thead>
               <tr class="bg-success">
                  <th data-sortable="true" data-field="tipo_documento">Tipo de documento</th>
                  <th data-sortable="true" data-field="documento">Documento</th>
                  <th data-sortable="true" data-field="nombre_completo">Estudiante</th>
                  <th data-sortable="true" data-field="telefono">Teléfono</th>
                  <th data-sortable="true" data-field="correo">Correo electrónico</th>
                  <th data-field="observaciones">Observaciones de la solicitud</th>
                  <th data-sortable="true" data-field="egresado" data-formatter="egresado">Egresado</th>
                  <th data-field="adj_documento" data-formatter="adjuntos">Adj. documento</th>
                  <th data-field="adj_estampilla" data-formatter="adjuntos">Adj. estampilla</th>
                  <th data-field="adj_pago" data-formatter="adjuntos">Adj pago</th>
                  <th data-field="certificados.tipo_certificado" data-formatter="certificados">Certificados solicitados
                  </th>
                  <th data-sortable="true" data-field="created_at">Fecha de la solicitud</th>
                  <th data-field="acciones" data-formatter="certificados">Acciones</th>

               </tr>
            </thead>
         </table>
      </div>
   </div>
@stop

@section('adminlte_js')
   <script src="https://unpkg.com/bootstrap-table@1.22.3/dist/bootstrap-table.min.js"></script>
   <script>
      const doc = document;
      doc.addEventListener('DOMContentLoaded', function() {
         let table = doc.getElementById('table');

         $('#table').bootstrapTable({
            url: '/solicitudes/admin/data',

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
         return `<ul>${certificados.join('')}</ul>`;
      }

      const baseUrl = "{{ url('/') }}";


      function adjuntos(value, row, index, field) {

         if (field == 'adj_documento') {
            return `<div class="text-center"><a class="btn btn-danger" href="${baseUrl}/${value}" target="_blank"><i class="fas fa-file-pdf"></i></a></div>`;
         }
         if (field == 'adj_estampilla') {
            return `<div class="text-center"><a class="btn btn-danger" href="${value}" target="_blank"><i class="fas fa-file-pdf"></i></a></div>`;
         }
         if (field == 'adj_pago') {
            return `<div class="text-center"><a class="btn btn-danger" href="${value}" target="_blank"><i class="fas fa-file-pdf"></i></a></div>`;
         }

         return `<ul>${certificados.join('')}</ul>`;
      }

      function egresado(value, row, index, field) {
         return value ? 'Sí' : 'No';
      }

      function acciones(value, row, index, field) {
         return `<a href="/certificados/${row.id}/edit" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
            <form action="/certificados/${row.id}" method="POST" class="frm d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
            </form>`;
      }
   </script>
@stop

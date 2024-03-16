@extends('adminlte::page')

@section('title', 'Tipos de certificado')

@section('adminlte_css')
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
   <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.22.3/dist/bootstrap-table.min.css">
@stop

@section('content_header')
   <h1>Certificados</h1>
@stop
@section('content')
   <div class="card">
      <div class="card-header">
         <div class="row">
            <div class="col">
               <h5 class="mb-0">Listado de certificados</h5>
            </div>
            <div class="col text-right">
               <a href="{{ route('certificados.create') }}" class="btn btn-primary btn-sm">Nuevo registro</a>
            </div>
         </div>
      </div>
      <div class="card-body ">
         <table id="table" class="table table-sm" data-search="true">
            <thead>
               <tr class="bg-success">
                  <th data-sortable="true" data-field="tipo_certificado">Tipo de certificado</th>
                  <th data-sortable="true" data-field="valor">Valor</th>
                  <th data-field="mensaje" data-formatter="validarCol">Menaje para mostrar</th>
                  <th data-sortable="true" data-field="estado" data-formatter="validarCol">Estado</th>
                  <th data-field="user.name">Usuario</th>
                  <th data-sortable="true" data-field="updated_at" data-formatter="validarCol">Fec. ult. cambio
                  <th data-field="acciones" data-formatter="validarCol">Acciones</th>
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
            url: '/certificados/data',

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

      function validarCol(value, row, index, field) {
         if (field == 'mensaje') {
            return value ? value : 'Sin mensaje';
         }
         if (field == 'estado') {
            return value ? '<span class="text-green">Activo</span>' : '<span class="text-danger">Inactivo</span>';
         }
         if (field == 'updated_at') {
            return value ? value : 'Sin fecha';
         }
         if (field == 'acciones') {

            return `<a href="/certificados/${row.id}/edit" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
            <form action="/certificados/${row.id}" method="POST" class="frm d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
            </form>`;
         }
      }
   </script>
@stop

@extends('adminlte::page') @section('title', 'Modulo de usuarios')
@section('adminlte_css')
<link
   rel="stylesheet"
   href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css"
/>
<link
   rel="stylesheet"
   href="https://unpkg.com/bootstrap-table@1.22.3/dist/bootstrap-table.min.css"
/>
@stop @section('content_header')
<h1>Listado de usuarios</h1>
@stop @section('content')
<div class="card">
   <div class="card-header">
      <div class="row">
         <div class="col">
            <h5 class="mb-0">Listado de Estudiantes</h5>
         </div>
         <div class="col text-right">
            <a href="{{ route('user.create') }}" class="btn btn-primary btn-sm"
               >Nuevo registro</a
            >
         </div>
      </div>
   </div>
   <div class="card-body">
      <table id="table" class="table table-sm" data-search="true">
         <thead>
            <tr class="bg-success">
               <th data-sortable="true" data-field="tipo_documento">
                  Tipo de certificado
               </th>
               <th data-sortable="true" data-field="documento">Documento</th>
               <th data-sortable="true" data-field="name">Nombre</th>
               <th data-sortable="true" data-field="telefono">Teléfono</th>
               <th data-sortable="true" data-field="email">Correo</th>
               <th
                  data-sortable="true"
                  data-field="estado"
                  data-formatter="validarCol"
               >
                  Estado
               </th>
               <th data-field="id" data-formatter="validarCol">
                  Acciones
               </th>
            </tr>
         </thead>
         <tbody>
            @foreach ($users as $user)
            <tr>
               <td>{{ app('tipo_documento')[$user->tipo_documento] }}</td>
               <td>{{ $user->documento }}</td>
               <td>{{ $user->name }}</td>
               <td>{{ $user->telefono }}</td>
               <td>{{ $user->email }}</td>
               <td>{{ $user->estado }}</td>
               <td>{{$user->id
                  }}</td>
            </tr>
            @endforeach
      </table>
   </div>
</div>
@stop @section('adminlte_js')
<script src="https://unpkg.com/bootstrap-table@1.22.3/dist/bootstrap-table.min.js"></script>
<script>
   const doc = document;
   doc.addEventListener("DOMContentLoaded", function () {
      $("#table").bootstrapTable({
         formatNoMatches: function () {
            return "No se encontraron registros";
         },
         formatSearch: function () {
            return "Buscar...";
         },
         onPostBody: function (data) {
            let forms = doc.querySelectorAll(".frm");
            forms.forEach((form) => {
               form.addEventListener("submit", function (event) {
                  event.preventDefault();
                  const formElement = this;
                  Swal.fire({
                     title: `"¿Desea ${
                        data.estado==1 ? "desativar" : "activar"
                     } este registro?"`,
                     text: "Esta acción no se puede deshacer",
                     icon: "warning",
                     showCancelButton: true,
                     confirmButtonColor: "#d33",
                     cancelButtonColor: "#3085d6",
                     confirmButtonText: "Sí",
                  }).then((result) => {
                     if (result.isConfirmed) {
                        formElement.submit();
                     }
                  });
               });
            });
         },
      });
   });

   function validarCol(value, row, index, field) {
      if (field == "estado") {
         return value==1
            ? '<span class="text-green">Activo</span>'
            : '<span class="text-danger">Inactivo</span>';
      }
      if (field == "id") {
         return `<a href="/usuarios/${
            row.id
         }/edit" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
            <form action="/usuarios/${row.id}/estado" method="POST" class="frm d-inline">
                @csrf
                @method('PUT')
                <button type="submit" class="btn btn-sm ${
                   row.estado==1 ? "btn-danger" : "btn-success"
                }"><i class="bi bi-trash"></i></button>
            </form>`;
      }
   }
</script>
@stop

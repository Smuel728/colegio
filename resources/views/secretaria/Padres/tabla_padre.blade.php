@extends('layout.panel')



@section('css')
<link rel="stylesheet" href="{{ asset('Datatables/datatables.min.css') }}">
<link href="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.13.4/b-2.3.6/b-colvis-2.3.6/b-html5-2.3.6/b-print-2.3.6/datatables.min.css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="ruta-a/bootstrap.min.css">
<style>
  .small-select {
    width: 200px;
  }
  
  .dataTables_paginate .paginate_button {
    padding: 3px 5px;
    margin: 0 5px;
    
  }
</style>
@endsection
@section('js')
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.13.4/b-2.3.6/b-colvis-2.3.6/b-html5-2.3.6/b-print-2.3.6/datatables.min.js"></script>

<script>
   $(document).ready(function() {
      $('#tablapadres').DataTable({
         lengthMenu: [ 9, 12],
         language: {
          lengthMenu: "Mostrar _MENU_ Entradas",
        loadingRecords: "Cargando...",
        processing: "Procesando...",
        search: "Buscar:",
        zeroRecords: "Sin resultados encontrados",
        info: "",
        infoEmpty: "Mostrando 0 to 0 of 0 Entradas",
        infoFiltered: "",
        paginate: {
          first: "Primero",
          last: "Ultimo",
          next: ">>",
          previous: "<<"
    },
    "sProcessing":"Cargando..."
}
         
      });
   });
</script>

@endsection
@section('content')

<div class="card shadow">
    <div class="card-header border-0">
      <div class="row align-items-center">
        <div class="col">
          <h1 class="mb-0">Padres</h1>
        </div>
        <div class="col text-right">
          <a href="{{route('padres.create')}}" class="btn btn-lg btn-primary">Nuevo Padre</a>
          <a href="{{route('padre.pdf')}}" class="btn btn-lg btn-primary">Reporte Padre</a>
        </div>
      </div>
    </div>
         <!-- Formulario para crear -->
         <div class="card-body">
  <form method="=get"> 
    <div class="input-group mb-2">
 
</div>
    <div class="card-body">
    @if (session('success'))
     <div class="alert alert-success" role="success">
      {{session('success')}}
  </div>
  @endif
 </form>
    <div class="table-responsive">
      <!-- Projects table -->
      <table id="tablapadres" class="table align-items-center table-flush">
        <thead class="thead-light">
          <tr>
            <th scope="col">N°</th>
            <th scope="col">Nombre</th>
            <th scope="col">Número de Identidad</th>
            <th scope="col">Teléfono Personal</th>
            <th scope="col">Tipo</th>
            <th scope="col">Opciones</th>
          </tr>
        </thead>
        <tbody>  
          @foreach ($padres as $index=> $padre)
              
          <tr>
            <th scope="row">
             {{$index + 0}}
            </th>
            <td>
              {{$padre->primernombre}} {{$padre->primerapellido}}
            </td>
            <td>
              {{$padre->numerodeidentidad}}
            </td>
            <td>
              {{$padre->telefonopersonal}}
            </td>
            <td>
              {{$padre->tipo}}
            </td>
           <td>
            
            <form action="{{url('/padres/'.$padre->id)}}" method="POST" class="formulario-eliminar">
              @csrf
              @method('DELETE')
              <a href="{{url('/padres/'.$padre->id.'/edit')}}" class="btn btn-sm btn-primary">Editar</a>
              <a href="{{route('padre.show', ['id'=> $padre -> id])}}" class="btn btn-sm btn-info">Ver</a>
              <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
            </form>
            
           </td>
           @endforeach
          </tr>
        </tbody>
      </table>
    </div>
    {{ $padres->links('vendor.pagination.bootstrap-4') }}
  </div>
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if (session('eliminar') == 'ok')
        <script> 
        Swal.fire(
      '¡Borrado!',
      'El usuario ha sido borrado exitosamente.',
      'Éxito'
    )
    
        </script>

@endif

<script>

  $('.formulario-eliminar').submit(function(e){
  e.preventDefault();


  Swal.fire({
  title: '¿Esta seguro?',
  text: "¡Si usted borra este registro no podra recuperarlo!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Si, borralo'
}).then((result) => {
  if (result.isConfirmed) {
  
    this.submit();
  }
})
  });

  
</script>

@if(session('success'))
  <script>
    Swal.fire({
      icon: 'success',
      title: '¡Perfecto!',
      text: '{{ session('success') }}',
      showConfirmButton: false,
      timer: 3000
    })
  </script>
  @endif

@endsection
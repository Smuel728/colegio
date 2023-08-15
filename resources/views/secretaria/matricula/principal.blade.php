@extends('layout.panel')

@section('css')
<link rel="stylesheet" href="{{ asset('Datatables/datatables.min.css') }}">
<link href="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.13.4/b-2.3.6/b-colvis-2.3.6/b-html5-2.3.6/b-print-2.3.6/datatables.min.css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="ruta-a/bootstrap.min.css">
<style>
    .small-select {
    width: 100px;
  }
  
  .dataTables_paginate .paginate_button {
    padding: 3px 5px;
    margin: 0 5px;
  }


.table {
  width: 100%;
  font-size: 14px;
}
    
</style>
@endsection

@section('js')
<script src="{{asset('Datatables/datatables.min.js')}}"></script>
<script>
$(document).ready(function() {
  var tabla = $('#matricula').DataTable({
    pagingType: 'simple_numbers',
    lengthMenu: [1, 6, 9, 12],
    language: {
      lengthMenu: "Mostrar _MENU_ Entradas",
      loadingRecords: "Cargando...",
      processing: "Procesando...",
      search: "Buscar:",
      zeroRecords: "Sin resultados encontrados",
      info: "_TOTAL_ Entradas",
      infoEmpty: "Mostrando 0 to 0 of 0 Entradas",
      infoFiltered: "",
      paginate: {
        first: "Primero",
        last: "Último",
        next: "Siguiente",
        previous: "Anterior"
      }
    }
  });

    $('#periodo').on('change', function() {
        var periodoId = $(this).val();

        if (periodoId) {
            tabla.column(4).search('^' + periodoId + '$', true, false).draw();
        } else {
            tabla.column(4).search('').draw();
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
                <h3 class="mb-0">Matriculados</h3>
            </div>
            <div class="col text-right">
                
                <a href="{{ route('principal.create',['no_matriculado'=>'en_proceso']) }}" class="nav-link  active " href="./index.html">Proceso de Matricula
                <i class="fas fa-history text-blue"></i> 
                </a>

                <a href="{{Route('creatematricula')}}" class="nav-link  active " href="./index.html">Nueva Matricula
                <i class="fas fa-user-plus text-green"></i> 
                </a>

                <a href="{{Route('repadre.pdf')}}" class="nav-link  active " href="./index.html">
                <i class="fas fa-file-alt text-orange"></i> 
                </a>

                <a href="{{Route('repalumno.pdf')}}" class="nav-link  active " href="./index.html">
                <i class="fas fa-file-alt text-yellow"></i> 
                </a>
               
              </div>
        </div>
    </div>
    <div class="card-body">
        @if (session('notification'))
        <div class="alert alert-success" role="alert">
            {{ session('notification') }}
        </div>
        @endif
    </div>

    <div class="table-responsive">
    
        <table id="matricula" class="table align-items-center table-flush">
            <thead class="thead-light">
                <tr>
                    <th scope="col">N°</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">N° de Identidad</th>
                    <th scope="col">Grado</th>
                    <th scope="col">Opciones</th>
                </tr>
            </thead>
            <tbody>
                @if ($alumnos)
                @foreach ($alumnos->items() as $index => $alumno)
                <tr>
                  @if(isset( $alumno->alumno->primernombre))
                    <td scope="row">
                        {{ $index + 1 }}
                    </td>
                    <th scope="row">
                        {{ $alumno->alumno->primernombre }} {{ $alumno->alumno->primerapellido }}
                    </th>
                    <td>
                        {{ $alumno->alumno->numerodeidentidad }}
                    </td>
                    <td>
                        {{ $alumno->curso->niveleducativo }}  {{ $alumno->curso->modalidad }}
                    </td>
                    <td>
                        <form action="{{ url('/alumnos/'.$alumno->id) }}" method="POST"
                            class="form-eliminaralumno">
                            @csrf
                            @method('DELETE')
                            <a href="{{ url('/alumnos/'.$alumno->alumno->id) }}" class="btn btn-sm btn-info">Ver</a>
                            <a href="{{ url('/alumnos/'.$alumno->alumno->id.'/edit') }}"
                                class="btn btn-sm btn-primary">Editar</a>
                            <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                        </form>
                        @php
                        $proce = App\Models\Proceso::where('id', '=', $alumno->alumno->id)->get();
                        @endphp
                        @if(count($proce) > 0)
                        <a class="btn btn-warning"
                            href="{{ route('creatematricula', ['id' => $alumno->alumno->id]) }}">Continuar
                            Matricula</a>
                        @endif
                    </td>
                    @else
                    <td scope="row">
                        {{ $index + 1 }}
                    </td>
                    <th scope="row">
                        {{ $alumno->primernombre }} {{ $alumno->primerapellido }}
                    </th>
                    <td>
                        {{ $alumno->numerodeidentidad }}
                    </td>
                    <td>
                        
                    </td>
                    <td>
                        <form action="{{ url('/alumnos/'.$alumno->id) }}" method="POST"
                            class="form-eliminaralumno">
                            @csrf
                            @method('DELETE')
                            <a href="{{ url('/alumnos/'.$alumno->id) }}" class="btn btn-sm btn-info">Ver</a>
                            <a href="{{ url('/alumnos/'.$alumno->id.'/edit') }}"
                                class="btn btn-sm btn-primary">Editar</a>
                            <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                        </form>
                        @php
                        $proce = App\Models\Proceso::where('id', '=', $alumno->id)->get();
                        @endphp
                        @if(count($proce) > 0)
                        <a class="btn btn-warning"
                            href="{{ route('creatematricula', ['id' => $alumno->id]) }}">Continuar
                            Matricula</a>
                        @endif
                    </td>
                    @endif
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
    </div>
    <hr> 
    </div>
@endsection



@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>




@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if (session('eliminar') == 'ok')
        <script> 
        Swal.fire(
      '¡Borrado!',
      'El Alumno ha sido borrado exitosamente.',
      'Éxito'
    )
    
        </script>

  
@endif

<script>

  $('.form-eliminaralumno').submit(function(e){
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

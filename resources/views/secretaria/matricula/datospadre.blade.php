@extends('layout.panel')

@section('content')

    <div class="card shadow">
        <div class="card-header border-0">
            <div class="row align-items-center">
            <div class="col">
                <h1 class="mb-0">Datos Padre</h1>
            </div>
            <div class="col text-right">
            <a href="#" onclick="window.history.back();" class="btn btn-lg btn-success">
                <i class="fas fa-angle-left"></i>
                Regresar</a>
            </div>
        </div>
    </div>

    <div class="card-body">
    @if ($errors->any())
          @foreach ($errors->all() as $error)
          <div class="alert alert-danger" role="alert">
            <i class="fas fa-exclamation-triangle"></i>
            <strong>¡Por favor!</strong> {{$error}}
        </div>
          @endforeach
      @endif
        <!-- inicio formulario -->

        <form class="row g-3 mt-3" action="{{route('submitpadre')}}" method="POST">
          @csrf
          <input type="hidden" name="alumno_id" value="{{ request()->input('alumno_id') }}">

        <div class="form-group col-2 mt-3">
            <label for="primernombre">Primer Nombre:</label>
        </div>
        <div class="col-4 mt-3">
            <input type="text" id="primernombre" name="primernombre" class="form-control" required maxlength="14" value="{{old('primernombre')}}"
            placeholder="Ingrese el primer nombre"></input>
        </div>

        <div class="form-group col-2 mt-3">
            <label for="segundonombre">Segundo Nombre:</label>
        </div>
        <div class="col-4 mt-3">
            <input type="text" id="segundonombre" name="segundonombre" class="form-control" required maxlength="14"  value="{{old('segundonombre')}}"
            placeholder="Ingrese el segundo nombre"></input>
        </div>

        <div class="form-group col-2 mt-3">
            <label for="primerapellido">Primer Apellido:</label>
        </div>
        <div class="col-4 mt-3">
            <input type="text" id="primerapellido" name="primerapellido" class="form-control" required maxlength="14" value="{{old('primerapellido')}}"
            placeholder="Ingrese el primer apellido"></input>
        </div>

        <div class="form-group col-2 mt-3">
            <label for="segundoapellido">Segundo Apellido:</label>
        </div>
        <div class="col-4 mt-3">
            <input type="text" id="segundoapellido" name="segundoapellido" class="form-control" maxlength="14" required value="{{old('segundoapellido')}}"
            placeholder="Ingrese el segundo apellido"></input>
        </div>

        <div class="form-group col-2 mt-3">
            <label for="numerodeidentidad">Número de Identidad:</label>
        </div>
        <div class="col-10 mt-3">
            <input type="text" id="identidad" name="numerodeidentidad" class="form-control" required maxlength="12" value="{{old('numerodeidentidad')}}"
            placeholder="Ingrese el número de identidad"></input>
        </div>

        <div class="form-group col-2 mt-3">
            <label for="telefonopersonal">Teléfono Personal:</label>
        </div>
        <div class="col-4 mt-3">
            <input type="text" id="telefonopersonal" name="telefonopersonal" class="form-control" required maxlength="8" value="{{old('telefonopersonal')}}"
            placeholder="Ingrese el télefono personal"></input>
        </div>

        <div class="form-group col-2 mt-3">
            <label for="lugardetrabajo">Lugar de Trabajo:</label>
        </div>
        <div class="col-4 mt-3">
            <input type="text" pattern="[A-Za-z\s\.]+" id="lugardetrabajo" name="lugardetrabajo" class="form-control" required maxlength="20" value="{{old('lugardetrabajo')}}"
            placeholder="Ingrese el lugar de trabajo"></input>
        </div>

        <div class="form-group col-2 mt-3">
            <label for="oficio">Profesion u Oficio:</label>
        </div>
        <div class="col-4 mt-3">
            <input type="text" pattern="[A-Za-z\s\.]+" id="oficio" name="oficio" class="form-control" required maxlength="16" value="{{old('oficio')}}"
            placeholder="Ingrese el oficio"></input>
        </div>

        <div class="form-group col-2 mt-3">
            <label for="telefonooficina">Teléfono de Oficina:</label>
        </div>
        <div class="col-4 mt-3">
            <input type="text" id="telefonooficina" name="telefonooficina" class="form-control" required maxlength="8" value="{{old('telefonooficina')}}"
            placeholder="Ingrese el télefono de oficina"></input>
        </div>

        <div class="form-group col-2 mt-3">
            <label for="ingresos">Ingresos:</label>
        </div>
        <div class="col-10 mt-3">
            <input type="number" id="ingresos" name="ingresos" class="form-control" required maxlength="10" value="{{old('ingresos')}}"
            placeholder="Ingrese los ingresos"></input>
        </div>



        <button type="submit" class="btn btn-primary btn-lg"  >Guardar</button>

    </form>
    </div>
</div>
@endSection
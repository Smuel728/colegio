<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>PDF Reportes Alumnos</title>
    <style>
        .cabecera {
            color: black;
        }

        .h1 {
            color: black;
        }

        table {
            border-collapse: collapse;
            margin: auto;
        }

        td, th {
            border: 1px solid black;
            padding: 5px;
        }
    </style>
</head>
<body>
<center><img src="{{ asset('img/brand/blue.png') }}" class="card-img-top" alt="..."
             style="width:70px;height:70px;"></center>
<center>
    <h4>INSTITUTO "COSME GARCIA C".</h4>
    <h3>MATRICULA CORRESPONDIENTE AL AÑO {{ date('Y') }}</h3>
</center>
<table class="table table-bordered" style="text-align: center; font-size: 15px;">
    <thead class="cabecera">
    <tr>
        <th scope="row">N°</th>
        <th scope="row">Nombre Del Alumno</th>
        <th scope="row">N° de Registro</th>
        <th scope="row">Fecha De Nacimiento</th>
        <th scope="row">Edad</th>
        <th scope="row">Instituto De Procedencia</th>
        <th scope="row">Padre o Encargado</th>
        <th scope="row">Dirección</th>
        <th scope="row">Fecha de Mátricula</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($alumnos as $index => $alumno)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $alumno->primernombre }} {{ $alumno->segundonombre }} {{ $alumno->primerapellido }} {{ $alumno->segundoapellido }}</td>
            <td>{{ $alumno->numerodeidentidad }}</td>
            <td>{{ $alumno->fechadenacimiento }}</td>
            <td>{{ \Carbon\Carbon::parse($alumno->fechadenacimiento)->diff(\Carbon\Carbon::now())->format('%y años') }}</td>
            <td>{{ $alumno->escuelaanterior }}</td>
            <td>
                @if(isset($padres[$index]))
                    {{ $padres[$index]->primernombre }} {{ $padres[$index]->primerapellido }}
                @endif
            </td>
            <td>{{ $alumno->direccion }}</td>
            <td>{{ \Carbon\Carbon::now()->format('d/m/Y') }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>

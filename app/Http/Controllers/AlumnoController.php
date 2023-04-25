<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\pdf;
use App\Models\Alumno;
use App\Models\Curso;
use Illuminate\Support\Facades\Cache;

class AlumnoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $alumnos = Alumno::paginate(10);
        return view('secretaria.Alumnos.index', compact('alumnos'));
    }

    public function pdf()
    {
        $alumnos = Alumno::All();
        $index = 1; // Definir la variable $index en el controlador
        $pdf = Pdf::loadView('secretaria.alumnos.pdf', compact('alumnos', 'index'));
        return $pdf->stream();
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('secretaria.alumnos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $rules = [
            'primernombre' => 'required|min:3|string',
            'segundonombre' => 'required|min:3|string',
            'primerapellido' => 'required|min:3|string',
            'segundoapellido' => 'sometimes|min:3|string',
            'numerodeidentidad' => 'required|min:13|numeric',
            'fechadenacimiento' => 'required|date',
            'alergia' => 'sometimes',
            'tiene_alergia' => 'sometimes',
            'genero' => 'required|min:1|string',
            'direccion' => 'required|string',
            'numerodehermanosenicgc' => 'required|numeric',
            'fotografias' => 'sometimes',
            'fotografiasdelpadre' => 'sometimes',
            'carnet' => 'sometimes',
            'certificadodeconductadeconducta' => 'sometimes',
            'ciudad' => 'required|min:3|max:16|string',
            'depto' => 'required|min:3|max:16|string',
            'pais' => 'required|min:3|max:16|string',
            'gradoingresar' => 'required|min:3|max:16|string',
            'escuelaanterior' => 'sometimes',
            'totalhermanos' => 'required|numeric',
            'medico' => 'required|min:3|max:12|string',
            'telefonoemergencia' => 'required|min:3|numeric'

        ];
        $messages = [
            'primernombre.required' => 'El primer nombre es requerido.',
            'primernombre.min' => 'El minimo son 3 caracteres.',

            'segundonombre.required' => 'El Segundo nombre es requerido.',
            'segundonombre.min' => 'El minimo son 3 caracteres.',

            'telefonoemergencia.required' => 'El número de telefono es necesario',
            'telefonoemergencia.min' => 'El numero de telefono tiene un minimo de 8 caracteres',
            'telefonoemergencia.numeric' => 'El número de telefono solo acepta números',
            'primerapellido.required' => 'El primer apellido es requerido.',
            'primerapellido.min' => 'El minimo son 3 caracteres.',

            'segundoapellido.min' => 'El minimo son 3 caracteres.',

            'numerodeidentidad.required' => 'El número de identidad es necesario.',
            'numerodeidentidad.min' => 'El minimo de caracteres del número de identidad es de 13 digitos',
            'numerodeidentidad.numeric' => 'El campo número de identidad solo permite números',
            'fechadenacimiento.required' => 'La fecha de nacimiento es necesaria.',
            'fechadenacimiento.date' => 'La fecha es necesaria',
            'genero.required' => 'M=Si es masculino, y F=Si es femenino',
            'genero.min' => 'Es necesario tener al menos 1 caracter en genero',

            'direccion.required' => 'El campo dirección es necesario',
            'numerodehermanosenicgc.required' => 'Sino tiene escriba "0"',
            'numerodehermanosenicgc.numeric' => 'Solo acepta números',
            'ciudad.required' => 'la cuidad es necesaria',
            'ciudad.min' => 'se necesita 3 caracteres como minimo',
            'depto.required' => 'el departamento es necesario',
            'depto.min' => 'se necesita  3 caracter como minimo',
            'pais.required' => 'es necesario el pais',
            'pais.min' => 'se necesita como 3 caracteres',
            'gradoingresar.required' => 'se necesita el grado',
            'gradoingresar.min' => 'se necesita como minimo 3 caracteres',
            'totalhermanos.required' => 'se necesita el total de hermanos',
            'medico.required' => 'se necesita el nombre del medico',
            'medico.min' => 'es necesario 3 caractares como minimo',
        ];
        $this->validate($request, $rules, $messages);


        Alumno::create(
            $request->only(
                'primernombre',
                'segundonombre',
                'primerapellido',
                'segundoapellido',
                'numerodeidentidad',
                'fechadenacimiento',
                'alergia',
                'lugardenacimiento',
                'genero',
                'direccion',
                'numerodehermanosenicgc',
                'fotografias',
                'fotografiasdelpadre',
                'carnet',
                'certificadodeconducta',
                'ciudad',
                'depto',
                'pais',
                'gradoingresar',
                'escuelaanterior',
                'totalhermanos',
                'medico',
                'telefonoemergencia'
            )
        );

        return redirect('/alumnos')->with('success', '¡El dato ha sido guardado/actualizado correctamente!');
    }

    public function creatematricula()
    {
        $cursos = Curso::pluck('curso', 'id');
        $value = Cache::get('alumno_id');

        if ($value) {
            $alumno = Alumno::find($value);
        } else {
            $alumno = new Alumno();
        }

        return view('secretaria.matricula.datosalumno', compact('alumno', 'cursos'));
    }

    public function storematricula(Request $request)
    {

        $value = Cache::get('alumno_id');
        $rules = [
            'primernombre' => 'required|min:3|max:12|string',
            'segundonombre' => 'required|min:3|max:12|string',
            'primerapellido' => 'required|min:3|max:12|string',
            'segundoapellido' => 'required|min:3|max:12|string',
            'numerodeidentidad' => 'required|min:13|numeric|unique:alumnos,numerodeidentidad,'. $value ,
            'fechadenacimiento' => 'required|date',
            'alergia' => 'sometimes',
            'tiene_alergia' => 'sometimes',
            'genero' => 'required|min:1|string',
            'direccion' => 'required|string',
            'numerodehermanosenicgc' => 'required|numeric',
            'fotografias' => 'sometimes',
            'fotografiasdelpadre' => 'sometimes',
            'carnet' => 'sometimes',
            'certificadodeconductadeconducta' => 'sometimes',
            'ciudad' => 'required|min:3|max:16|string',
            'depto' => 'required|min:3|max:16|string',
            'pais' => 'required|min:3|max:16|string',
            'escuelaanterior' => 'sometimes',
            'totalhermanos' => 'required|numeric',
            'medico' => 'required|min:3|max:18|string',
            'telefonoemergencia' => 'required|min:3|numeric',
            'curso_id' => 'required|exists:cursos,id',

        ];
        $messages = [
            'primernombre.required' => 'El primer nombre es requerido.',
            'primernombre.max' => 'El maximo de primer nombre son 12 caracteres.',
            'primernombre.min' => 'El minimo  de primer nombre son 3 caracteres.',

            'segundonombre.required' => 'El Segundo nombre es requerido.',
            'segundonombre.min' => 'El minimo de Segundo nombre son 3 caracteres.',
            'segundonombre.max' => 'El maximo de Segundo nombre son 12 caracteres.',

            'telefonoemergencia.required' => 'El número de telefono es necesario',
            'telefonoemergencia.min' => 'El numero de telefono tiene un minimo de 8 caracteres',
            'telefonoemergencia.numeric' => 'El número de telefono solo acepta números',
            'primerapellido.required' => 'El primer apellido es requerido.',
            'primerapellido.min' => 'El minimo de primer apellido son 3 caracteres.',
            'primerapellido.max' => 'El maximo de primer apellido son 12 caracteres.',

            'segundoapellido.required' => 'El segundo apellido es requerido.',
            'segundoapellido.min' => 'El minimo de segundo apellido son 3 caracteres.',
            'segundoapellido.max' => 'El maximo de segundo apellido son 12 caracteres.',

            'numerodeidentidad.required' => 'El número de identidad es necesario.',
            'numerodeidentidad.min' => 'El minimo de caracteres del número de identidad es de 13 digitos',
            'numerodeidentidad.numeric' => 'El campo número de identidad solo permite números',
            'numerodeidentidad.unique' => 'El campo número de identidad debe ser unico',

            'fechadenacimiento.required' => 'La fecha de nacimiento es necesaria.',
            'fechadenacimiento.date' => 'La fecha es necesaria',
            'genero.required' => 'seleccion si es masculino, o es femenino',
            'genero.min' => 'Es necesario tener al menos 1 caracter en genero',

            'direccion.required' => 'El campo dirección es necesario',
            'numerodehermanosenicgc.required' => 'Sino hermanos tiene escriba "0"',
            'numerodehermanosenicgc.numeric' => 'Solo acepta números',
            'ciudad.required' => 'la cuidad es necesaria',
            'ciudad.min' => 'se necesita 3 caracteres como minimo',
            'depto.required' => 'el departamento es necesario',
            'depto.min' => 'se necesita  3 caracter como minimo',
            'pais.required' => 'es necesario el pais',
            'pais.min' => 'se necesita como 3 caracteres',
            'totalhermanos.required' => 'se necesita el total de hermanos',
            'medico.required' => 'se necesita el nombre del medico',
            'medico.min' => 'es necesario 3 caractares como minimo',
            'medico.max' => 'El maximo del nombre del doctor son 12 caracteres.',
        ];
        $this->validate($request, $rules, $messages);



        if ($value) {
            $alumno = Alumno::findOrFail($value);
            $alumno->update($request->only(
                'primernombre',
                'segundonombre',
                'primerapellido',
                'segundoapellido' ,
                'numerodeidentidad' ,
                'fechadenacimiento',
                'alergia',
                'tiene_alergia',
                'lugardenacimiento',
                'genero',
                'direccion',
                'numerodehermanosenicgc',
                'fotografias',
                'fotografiasdelpadre',
                'carnet',
                'certificadodeconducta',
                'ciudad',
                'depto',
                'pais',
                'escuelaanterior',
                'totalhermanos' ,
                'medico',
                'telefonoemergencia',
                'curso_id'
            ));

        } else {
            $cursos = Curso::find($request->input('curso_id'));

            $alumno = Alumno::create([
                'primernombre' => $request->input('primernombre'),
                'segundonombre' => $request->input('segundonombre'),
                'primerapellido' => $request->input('primerapellido'),
                'segundoapellido' => $request->input('segundoapellido'),
                'numerodeidentidad' => $request->input('numerodeidentidad'),
                'fechadenacimiento' => $request->input('fechadenacimiento'),
                'alergia' => $request->input('alergia'),
                'tiene_alergia' => $request->input('tiene_alergia'),
                'lugardenacimiento' => $request->input('lugardenacimiento'),
                'genero' => $request->input('genero'),
                'direccion' => $request->input('direccion'),
                'numerodehermanosenicgc' => $request->input('numerodehermanosenicgc'),
                'fotografias' => $request->has('fotografias') ? true : false,
                'fotografiasdelpadre' => $request->has('fotografiasdelpadre') ? true : false,
                'carnet' => $request->has('carnet') ? true : false,
                'certificadodeconducta' => $request->has('certificadodeconducta') ? true : false,
                'ciudad' => $request->input('ciudad'),
                'depto' => $request->input('depto'),
                'pais' => $request->input('pais'),
                'escuelaanterior' => $request->input('escuelaanterior'),
                'totalhermanos' => $request->input('totalhermanos'),
                'medico' => $request->input('medico'),
                'telefonoemergencia' => $request->input('telefonoemergencia'),
                'curso_id' => $cursos->id,
            ]);

            session(['alumno_id' => $alumno->id]);
            Cache::put('alumno_id', $alumno->id);
        }

        Cache::put('padre', $request->input('padre'));
        Cache::put('madre', $request->input('madre'));
        Cache::put('encargado', $request->input('encargado'));

        if ($request->input('padre') == '1') {
            return redirect()->route('datospadre.create');
        }
        if ($request->input('madre') == '2') {
            return redirect('/alumnomadre');
        }
        if ($request->input('encargado') == '3') {
            return redirect('/alumnoencargado');
        }

        return redirect()->route('creatematricula')->with('success','Se enecesita registrar algun encargado');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $i
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $alumnos = Alumno::findOrFail($id);
        $padres = $alumnos->padres;
        return view('secretaria.alumnos.show', compact('alumnos', 'padres'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $alumnos = Alumno::findOrFail($id);
        return view('secretaria.alumnos.edit', compact('alumnos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'primernombre' => 'required|min:3|string',
            'segundonombre' => 'required|min:3|string',
            'telefonodeencargado' => 'required|min:8|numeric',
            'primerapellido' => 'required|min:3|string',
            'segundoapellido' => 'sometimes|min:3|string',
            'numerodeidentidad' => 'required|min:13|numeric',
            'fechadenacimiento' => 'required|date',
            'alergia' => 'required|min:2|string',
            'lugardenacimiento' => 'required|min:2|string',
            'genero' => 'required|min:1|string',
            'direccion' => 'required|string',
            'numerodehermanosenicgc' => 'required|numeric',
            'fotografias' => 'sometimes',
            'fotografiasdelpadre' => 'sometimes',
            'carnet' => 'sometimes',
            'certificadodeconductadeconducta' => 'sometimes',
        ];
        $messages = [
            'primernombre.required' => 'El primer nombre es requerido.',
            'primernombre.min' => 'El minimo son 3 caracteres.',

            'segundonombre.required' => 'El Segundo nombre es requerido.',
            'segundonombre.min' => 'El minimo son 3 caracteres.',

            'telefonodeencargado.required' => 'El número de telefono es necesario',
            'telefonodeencargado.min' => 'El numero de telefono tiene un minimo de 8 caracteres',
            'telefonodeencargado.numeric' => 'El número de telefono solo acepta números',
            'primerapellido.required' => 'El primer apellido es requerido.',
            'primerapellido.min' => 'El minimo son 3 caracteres.',

            'segundoapellido.min' => 'El minimo son 3 caracteres.',

            'numerodeidentidad.required' => 'El número de identidad es necesario.',
            'numerodeidentidad.min' => 'El minimo de caracteres del número de identidad es de 13 digitos',
            'numerodeidentidad.numeric' => 'El campo número de identidad solo permite números',
            'fechadenacimiento.required' => 'La fecha de nacimiento es necesaria.',
            'fechadenacimiento.date' => 'La fecha es necesaria',
            'alergia.required' => 'Escriba SI, si tiene alergia; sino escriba NO',
            'alergia.min' => 'Se necesitan 2 caracteres como minimo para alergia',
            'alergia.alpha' => 'Alergia solo acepta letras',
            'genero.required' => 'M=Si es masculino, y F=Si es femenino',
            'genero.min' => 'Es necesario tener al menos 1 caracter en genero',

            'direccion.required' => 'El campo dirección es necesario',
            'numerodehermanosenicgc.required' => 'Sino tiene escriba "0"',
            'numerodehermanosenicgc.numeric' => 'Solo acepta números',
        ];
        $this->validate($request, $rules, $messages);

        $alumnos = Alumno::findOrFail($id);

        $alumnos->update($request->only(
            'primernombre',
            'segundonombre',
            'telefonodeencargado',
            'primerapellido',
            'segundoapellido',
            'numerodeidentidad',
            'fechadenacimiento',
            'alergia',
            'lugardenacimiento',
            'genero',
            'direccion',
            'numerodehermanosenicgc',
            'fotografias',
            'fotografiasdelpadre',
            'carnet',
            'certificadodeconducta'
        ));

        return redirect('/alumnos')->with('success', '¡El dato ha sido guardado/actualizado correctamente!');
    }

    public function comprobar(Request $request)
    {
       $alumnos = Alumno::where('numerodeidentidad','=',$request->input('identidad'))->get();

       if (isset($alumnos[0]->id)) {
        Cache::put('alumno_id', $alumnos[0]->id);
        return redirect()->route('creatematricula')->with('success', '¡Matricula Existente!');
       }else{
        Cache::forget('alumno_id');
        return redirect()->route('creatematricula')->with('success', '¡Alumno no matriculado!')->with('identidad', $request->input('identidad'));
       }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $alumnos = Alumno::findOrfail($id);
        $alumnos->delete();


        return redirect('/alumnos')->with('eliminar', 'ok');
    }
}

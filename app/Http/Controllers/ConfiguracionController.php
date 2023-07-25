<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ConfiguracionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('configurar.index');
    }

    public function indexJornada()
    {
        return view('configurar.jornada');
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createJornada()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validar los datos enviados por el formulario
        $validatedData = $request->validate([
            'jornada' => 'required|string|max:255',
            'descripcion' => 'required|string|max:255',
        ]);

        // Crear una nueva instancia del modelo Jornada y asignar los valores del formulario
        $jornada = new Jornada();
        $jornada->jornada = $validatedData['jornada'];
        $jornada->descripcion = $validatedData['descripcion'];

        // Guardar la jornada en la base de datos
        $jornada->save();

        // Redirigir a la página de índice de jornadas o a donde desees después de guardar
        return redirect()->route('jornada.index'); // Cambia 'jornada.index' por la ruta de tu página de índice de jornadas
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

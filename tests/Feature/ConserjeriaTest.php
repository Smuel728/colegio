<?php

namespace Tests\Feature;

use App\Models\Alumno;
use App\Models\Consejeria;
use App\Models\Firmacontrato;
use App\Models\Padre;
use App\Models\User;
use Carbon\Carbon;
use Tests\TestCase;

class CansergeriaTest extends TestCase
{
    public function test_1_la_ruta_deberia_retornar_respuesta_302_sin_usuario_logueado()
    {
        $response = $this->get('/tablaindex');
        $response->assertStatus(302);
    }

    public function test_2_la_vista_existe_redirigue_login_sin_usuario_logueado()
    {
        $response = $this->get('/tablaindex');
        $response->assertRedirect('/login');
    }

    public function test_3_la_ruta_deberia_retornar_respuesta_exitosa_con_usuario_logueado()
    {
        $user = User::find(1);
        $this->actingAs($user);

        $response = $this->get('/tablaindex');
        $response->assertStatus(200);
    }

    public function test_4_la_vista_existe_con_usuario_logueado()
    {
        $user = User::find(1);
        $this->actingAs($user);

        $response = $this->get('/tablaindex');
        $response->assertViewIs('consejeria.tablaindex');
    }

    public function test_5_la_pagina_de_indice_contiene_titulo_del_departamento()
    {
        $user = User::find(1);
        $this->actingAs($user);
        $response = $this->get('/tablaindex');

        $response->assertSee('Departamento de Consejeria');
    }

    public function test_6_la_pagina_de_indice_contiene_complemento_busqueda()
    {
        $user = User::find(1);
        $this->actingAs($user);

        $response = $this->get('/tablaindex');

        $response->assertSee('Buscar:');
    }

    public function test_7_la_pagina_de_indice_contiene_datos_de_alumno_recientemente_registrado()
    {
        $user = User::find(1);
        $this->actingAs($user);

        $alumno = Alumno::firstOrCreate(
            [
                'numerodeidentidad' => '0703199600455',
            ],[
            'primernombre' => 'Juan',
            'segundonombre' => 'Antonio',
            'primerapellido' => 'Pérez',
            'segundoapellido' => 'García',
            'fechadenacimiento' => '1995-07-16',
            'genero' => 'masculino',
            'direccion' => 'Barrio La Esperanza',
            'numerodehermanosenicgc' => 1,
            'tiene_alergia' => 0,
            'alergia' => null,
            'fotografias' => 1,
            'fotografiasdelpadre' => 1,
            'carnet' => 1,
            'certificadodeconducta' => 1,
            'created_at' => '2023-11-15 12:28:58',
            'updated_at' => '2023-11-15 12:28:58',
            'ciudad' => 'San Pedro Sula',
            'depto' => 'Cortés',
            'pais' => 'Honduras',
            'escuelaanterior' => 'José Cecilio del Valle',
            'totalhermanos' => 1,
            'medico' => 'Dr. Martínez',
            'telefonoemergencia' => '98003699',
            'bus' => 1,
            'taxi' => 0,
            'conpadre' => 1,
            'solo' => 0,
        ]);

        $response = $this->get('/tablaindex');

        $response->assertSee('0703199600455');
        $response->assertSee('Juan Antonio Pérez García');
    }

    public function test_8_la_pagina_de_indice_contiene_datos_de_alumno_recientemente_registrado_boton_ver_proceso()
    {
        $user = User::find(1);
        $this->actingAs($user);

        $alumno = Alumno::firstOrCreate(
            [
                'numerodeidentidad' => '0703199600455',
            ],[
            'primernombre' => 'Juan',
            'segundonombre' => 'Antonio',
            'primerapellido' => 'Pérez',
            'segundoapellido' => 'García',
            'fechadenacimiento' => '1995-07-16',
            'genero' => 'masculino',
            'direccion' => 'Barrio La Esperanza',
            'numerodehermanosenicgc' => 1,
            'tiene_alergia' => 0,
            'alergia' => null,
            'fotografias' => 1,
            'fotografiasdelpadre' => 1,
            'carnet' => 1,
            'certificadodeconducta' => 1,
            'created_at' => '2023-11-15 12:28:58',
            'updated_at' => '2023-11-15 12:28:58',
            'ciudad' => 'San Pedro Sula',
            'depto' => 'Cortés',
            'pais' => 'Honduras',
            'escuelaanterior' => 'José Cecilio del Valle',
            'totalhermanos' => 1,
            'medico' => 'Dr. Martínez',
            'telefonoemergencia' => '98003699',
            'bus' => 1,
            'taxi' => 0,
            'conpadre' => 1,
            'solo' => 0,
        ]);

        $response = $this->get('/tablaindex');

        $response->assertSee('Ver Proceso');
    }


    public function test_9_la_ruta_ver_proceso_deberia_retornar_respuesta_302_sin_usuario_logueado()
    {

        $alumno = Alumno::firstOrCreate(
            [
                'numerodeidentidad' => '0703199600455',
            ],[
            'primernombre' => 'Juan',
            'segundonombre' => 'Antonio',
            'primerapellido' => 'Pérez',
            'segundoapellido' => 'García',
            'fechadenacimiento' => '1995-07-16',
            'genero' => 'masculino',
            'direccion' => 'Barrio La Esperanza',
            'numerodehermanosenicgc' => 1,
            'tiene_alergia' => 0,
            'alergia' => null,
            'fotografias' => 1,
            'fotografiasdelpadre' => 1,
            'carnet' => 1,
            'certificadodeconducta' => 1,
            'created_at' => '2023-11-15 12:28:58',
            'updated_at' => '2023-11-15 12:28:58',
            'ciudad' => 'San Pedro Sula',
            'depto' => 'Cortés',
            'pais' => 'Honduras',
            'escuelaanterior' => 'José Cecilio del Valle',
            'totalhermanos' => 1,
            'medico' => 'Dr. Martínez',
            'telefonoemergencia' => '98003699',
            'bus' => 1,
            'taxi' => 0,
            'conpadre' => 1,
            'solo' => 0,
        ]);
        $response = $this->get('consjindex/'.$alumno->id);
        $response->assertStatus(302);
    }

    public function test_10_ruta_ver_proceso_deberia_redirigir_al_login_sin_usuario_logueado()
    {
        $alumno = Alumno::firstOrCreate(
            [
                'numerodeidentidad' => '0703199600455',
            ],[
            'primernombre' => 'Juan',
            'segundonombre' => 'Antonio',
            'primerapellido' => 'Pérez',
            'segundoapellido' => 'García',
            'fechadenacimiento' => '1995-07-16',
            'genero' => 'masculino',
            'direccion' => 'Barrio La Esperanza',
            'numerodehermanosenicgc' => 1,
            'tiene_alergia' => 0,
            'alergia' => null,
            'fotografias' => 1,
            'fotografiasdelpadre' => 1,
            'carnet' => 1,
            'certificadodeconducta' => 1,
            'created_at' => '2023-11-15 12:28:58',
            'updated_at' => '2023-11-15 12:28:58',
            'ciudad' => 'San Pedro Sula',
            'depto' => 'Cortés',
            'pais' => 'Honduras',
            'escuelaanterior' => 'José Cecilio del Valle',
            'totalhermanos' => 1,
            'medico' => 'Dr. Martínez',
            'telefonoemergencia' => '98003699',
            'bus' => 1,
            'taxi' => 0,
            'conpadre' => 1,
            'solo' => 0,
        ]);
        $response = $this->get('consjindex/'.$alumno->id);
        $response->assertRedirect('/login');
    }

    public function test_11_la_ruta_ver_proceso_deberia_retornar_respuesta_200()
    {
        $user = User::find(1);
        $this->actingAs($user);

        $alumno = Alumno::firstOrCreate(
            [
                'numerodeidentidad' => '0703199600455',
            ],[
            'primernombre' => 'Juan',
            'segundonombre' => 'Antonio',
            'primerapellido' => 'Pérez',
            'segundoapellido' => 'García',
            'fechadenacimiento' => '1995-07-16',
            'genero' => 'masculino',
            'direccion' => 'Barrio La Esperanza',
            'numerodehermanosenicgc' => 1,
            'tiene_alergia' => 0,
            'alergia' => null,
            'fotografias' => 1,
            'fotografiasdelpadre' => 1,
            'carnet' => 1,
            'certificadodeconducta' => 1,
            'created_at' => '2023-11-15 12:28:58',
            'updated_at' => '2023-11-15 12:28:58',
            'ciudad' => 'San Pedro Sula',
            'depto' => 'Cortés',
            'pais' => 'Honduras',
            'escuelaanterior' => 'José Cecilio del Valle',
            'totalhermanos' => 1,
            'medico' => 'Dr. Martínez',
            'telefonoemergencia' => '98003699',
            'bus' => 1,
            'taxi' => 0,
            'conpadre' => 1,
            'solo' => 0,
        ]);
        $response = $this->get('consjindex/'.$alumno->id);
        $response->assertStatus(200);
    }

    public function test_12_ruta_ver_proceso_deberia_redirigir_a_la_vista_consjindex()
    {
        $user = User::find(1);
        $this->actingAs($user);

        $alumno = Alumno::firstOrCreate(
            [
                'numerodeidentidad' => '0703199600455',
            ],[
            'primernombre' => 'Juan',
            'segundonombre' => 'Antonio',
            'primerapellido' => 'Pérez',
            'segundoapellido' => 'García',
            'fechadenacimiento' => '1995-07-16',
            'genero' => 'masculino',
            'direccion' => 'Barrio La Esperanza',
            'numerodehermanosenicgc' => 1,
            'tiene_alergia' => 0,
            'alergia' => null,
            'fotografias' => 1,
            'fotografiasdelpadre' => 1,
            'carnet' => 1,
            'certificadodeconducta' => 1,
            'created_at' => '2023-11-15 12:28:58',
            'updated_at' => '2023-11-15 12:28:58',
            'ciudad' => 'San Pedro Sula',
            'depto' => 'Cortés',
            'pais' => 'Honduras',
            'escuelaanterior' => 'José Cecilio del Valle',
            'totalhermanos' => 1,
            'medico' => 'Dr. Martínez',
            'telefonoemergencia' => '98003699',
            'bus' => 1,
            'taxi' => 0,
            'conpadre' => 1,
            'solo' => 0,
        ]);
        $response = $this->get('consjindex/'.$alumno->id);
        $response->assertViewIs('consejeria.consjindex');
    }

    public function test_13_ruta_ver_proceso_contiene_complemento_titulo()
    {
        $user = User::find(1);
        $this->actingAs($user);

        $alumno = Alumno::firstOrCreate(
            [
                'numerodeidentidad' => '0703199600455',
            ],[
            'primernombre' => 'Juan',
            'segundonombre' => 'Antonio',
            'primerapellido' => 'Pérez',
            'segundoapellido' => 'García',
            'fechadenacimiento' => '1995-07-16',
            'genero' => 'masculino',
            'direccion' => 'Barrio La Esperanza',
            'numerodehermanosenicgc' => 1,
            'tiene_alergia' => 0,
            'alergia' => null,
            'fotografias' => 1,
            'fotografiasdelpadre' => 1,
            'carnet' => 1,
            'certificadodeconducta' => 1,
            'created_at' => '2023-11-15 12:28:58',
            'updated_at' => '2023-11-15 12:28:58',
            'ciudad' => 'San Pedro Sula',
            'depto' => 'Cortés',
            'pais' => 'Honduras',
            'escuelaanterior' => 'José Cecilio del Valle',
            'totalhermanos' => 1,
            'medico' => 'Dr. Martínez',
            'telefonoemergencia' => '98003699',
            'bus' => 1,
            'taxi' => 0,
            'conpadre' => 1,
            'solo' => 0,
        ]);
        $response = $this->get('consjindex/'.$alumno->id);
        $response->assertSee('Confirmacion de Pasos de Matricula');
    }

    public function test_14_ruta_ver_proceso_contiene_complemento_nombre_alumno()
    {
        $user = User::find(1);
        $this->actingAs($user);

        $alumno = Alumno::firstOrCreate(
            [
                'numerodeidentidad' => '0703199600455',
            ],[
            'primernombre' => 'Juan',
            'segundonombre' => 'Antonio',
            'primerapellido' => 'Pérez',
            'segundoapellido' => 'García',
            'fechadenacimiento' => '1995-07-16',
            'genero' => 'masculino',
            'direccion' => 'Barrio La Esperanza',
            'numerodehermanosenicgc' => 1,
            'tiene_alergia' => 0,
            'alergia' => null,
            'fotografias' => 1,
            'fotografiasdelpadre' => 1,
            'carnet' => 1,
            'certificadodeconducta' => 1,
            'created_at' => '2023-11-15 12:28:58',
            'updated_at' => '2023-11-15 12:28:58',
            'ciudad' => 'San Pedro Sula',
            'depto' => 'Cortés',
            'pais' => 'Honduras',
            'escuelaanterior' => 'José Cecilio del Valle',
            'totalhermanos' => 1,
            'medico' => 'Dr. Martínez',
            'telefonoemergencia' => '98003699',
            'bus' => 1,
            'taxi' => 0,
            'conpadre' => 1,
            'solo' => 0,
        ]);
        $response = $this->get('consjindex/'.$alumno->id);
        $response->assertSee('Juan Antonio Pérez García');
    }

    public function test_15_ruta_ver_proceso_contiene_complemento_fecha_actual()
    {
        $user = User::find(1);
        $this->actingAs($user);

        $alumno = Alumno::firstOrCreate(
            [
                'numerodeidentidad' => '0703199600455',
            ],[
            'primernombre' => 'Juan',
            'segundonombre' => 'Antonio',
            'primerapellido' => 'Pérez',
            'segundoapellido' => 'García',
            'fechadenacimiento' => '1995-07-16',
            'genero' => 'masculino',
            'direccion' => 'Barrio La Esperanza',
            'numerodehermanosenicgc' => 1,
            'tiene_alergia' => 0,
            'alergia' => null,
            'fotografias' => 1,
            'fotografiasdelpadre' => 1,
            'carnet' => 1,
            'certificadodeconducta' => 1,
            'created_at' => '2023-11-15 12:28:58',
            'updated_at' => '2023-11-15 12:28:58',
            'ciudad' => 'San Pedro Sula',
            'depto' => 'Cortés',
            'pais' => 'Honduras',
            'escuelaanterior' => 'José Cecilio del Valle',
            'totalhermanos' => 1,
            'medico' => 'Dr. Martínez',
            'telefonoemergencia' => '98003699',
            'bus' => 1,
            'taxi' => 0,
            'conpadre' => 1,
            'solo' => 0,
        ]);
        $response = $this->get('consjindex/'.$alumno->id);
        $response->assertSee(Carbon::now()->format('d/m/Y'));
    }

    public function test_16_ruta_ver_proceso_contiene_complemento_boton_regresar()
    {
        $user = User::find(1);
        $this->actingAs($user);

        $alumno = Alumno::firstOrCreate(
            [
                'numerodeidentidad' => '0703199600455',
            ],[
            'primernombre' => 'Juan',
            'segundonombre' => 'Antonio',
            'primerapellido' => 'Pérez',
            'segundoapellido' => 'García',
            'fechadenacimiento' => '1995-07-16',
            'genero' => 'masculino',
            'direccion' => 'Barrio La Esperanza',
            'numerodehermanosenicgc' => 1,
            'tiene_alergia' => 0,
            'alergia' => null,
            'fotografias' => 1,
            'fotografiasdelpadre' => 1,
            'carnet' => 1,
            'certificadodeconducta' => 1,
            'created_at' => '2023-11-15 12:28:58',
            'updated_at' => '2023-11-15 12:28:58',
            'ciudad' => 'San Pedro Sula',
            'depto' => 'Cortés',
            'pais' => 'Honduras',
            'escuelaanterior' => 'José Cecilio del Valle',
            'totalhermanos' => 1,
            'medico' => 'Dr. Martínez',
            'telefonoemergencia' => '98003699',
            'bus' => 1,
            'taxi' => 0,
            'conpadre' => 1,
            'solo' => 0,
        ]);
        $response = $this->get('consjindex/'.$alumno->id);
        $response->assertSee('Regresar');
    }


    public function test_17_ruta_ver_proceso_contiene_complemento_boton_regresar()
    {
        $user = User::find(1);
        $this->actingAs($user);

        $alumno = Alumno::firstOrCreate(
            [
                'numerodeidentidad' => '0703199600455',
            ],[
            'primernombre' => 'Juan',
            'segundonombre' => 'Antonio',
            'primerapellido' => 'Pérez',
            'segundoapellido' => 'García',
            'fechadenacimiento' => '1995-07-16',
            'genero' => 'masculino',
            'direccion' => 'Barrio La Esperanza',
            'numerodehermanosenicgc' => 1,
            'tiene_alergia' => 0,
            'alergia' => null,
            'fotografias' => 1,
            'fotografiasdelpadre' => 1,
            'carnet' => 1,
            'certificadodeconducta' => 1,
            'created_at' => '2023-11-15 12:28:58',
            'updated_at' => '2023-11-15 12:28:58',
            'ciudad' => 'San Pedro Sula',
            'depto' => 'Cortés',
            'pais' => 'Honduras',
            'escuelaanterior' => 'José Cecilio del Valle',
            'totalhermanos' => 1,
            'medico' => 'Dr. Martínez',
            'telefonoemergencia' => '98003699',
            'bus' => 1,
            'taxi' => 0,
            'conpadre' => 1,
            'solo' => 0,
        ]);
        $response = $this->get('consjindex/'.$alumno->id);
        $response->assertSee('Regresar');
    }

    public function test_18_ruta_ver_proceso_contiene_complemento_boton_aceptar()
    {
        $user = User::find(1);
        $this->actingAs($user);

        $alumno = Alumno::firstOrCreate(
            [
                'numerodeidentidad' => '0703199600455',
            ],[
            'primernombre' => 'Juan',
            'segundonombre' => 'Antonio',
            'primerapellido' => 'Pérez',
            'segundoapellido' => 'García',
            'fechadenacimiento' => '1995-07-16',
            'genero' => 'masculino',
            'direccion' => 'Barrio La Esperanza',
            'numerodehermanosenicgc' => 1,
            'tiene_alergia' => 0,
            'alergia' => null,
            'fotografias' => 1,
            'fotografiasdelpadre' => 1,
            'carnet' => 1,
            'certificadodeconducta' => 1,
            'created_at' => '2023-11-15 12:28:58',
            'updated_at' => '2023-11-15 12:28:58',
            'ciudad' => 'San Pedro Sula',
            'depto' => 'Cortés',
            'pais' => 'Honduras',
            'escuelaanterior' => 'José Cecilio del Valle',
            'totalhermanos' => 1,
            'medico' => 'Dr. Martínez',
            'telefonoemergencia' => '98003699',
            'bus' => 1,
            'taxi' => 0,
            'conpadre' => 1,
            'solo' => 0,
        ]);
        $response = $this->get('consjindex/'.$alumno->id);
        $response->assertSee('Aceptar');
    }


    public function test_19_ruta_guardar_la_confirmacion_de_paso_de_matricula_check_secretaria()
    {
        $user = User::find(1);
        $this->actingAs($user);

        $alumno = Alumno::firstOrCreate(
            [
                'numerodeidentidad' => '0703199600455',
            ],[
            'primernombre' => 'Juan',
            'segundonombre' => 'Antonio',
            'primerapellido' => 'Pérez',
            'segundoapellido' => 'García',
            'fechadenacimiento' => '1995-07-16',
            'genero' => 'masculino',
            'direccion' => 'Barrio La Esperanza',
            'numerodehermanosenicgc' => 1,
            'tiene_alergia' => 0,
            'alergia' => null,
            'fotografias' => 1,
            'fotografiasdelpadre' => 1,
            'carnet' => 1,
            'certificadodeconducta' => 1,
            'created_at' => '2023-11-15 12:28:58',
            'updated_at' => '2023-11-15 12:28:58',
            'ciudad' => 'San Pedro Sula',
            'depto' => 'Cortés',
            'pais' => 'Honduras',
            'escuelaanterior' => 'José Cecilio del Valle',
            'totalhermanos' => 1,
            'medico' => 'Dr. Martínez',
            'telefonoemergencia' => '98003699',
            'bus' => 1,
            'taxi' => 0,
            'conpadre' => 1,
            'solo' => 0,
        ]);

        $response = $this->post('/tablaindex',[
            'id_alumno' => $alumno->id,
            'secretaria' => 1,
            'orientacion' => 0,
            'consej' => 0,
            'tesoreria' => 0,
            'secultimo' => 0,
        ]);


        $this->assertTrue(Consejeria::where('id_alumno',$alumno->id)->first()->secretaria === 1);

    }

    public function test_20_ruta_guardar_la_confirmacion_de_paso_de_matricula_check_orientacion()
    {
        $user = User::find(1);
        $this->actingAs($user);

        $alumno = Alumno::firstOrCreate(
            [
                'numerodeidentidad' => '0703199600455',
            ],[
            'primernombre' => 'Juan',
            'segundonombre' => 'Antonio',
            'primerapellido' => 'Pérez',
            'segundoapellido' => 'García',
            'fechadenacimiento' => '1995-07-16',
            'genero' => 'masculino',
            'direccion' => 'Barrio La Esperanza',
            'numerodehermanosenicgc' => 1,
            'tiene_alergia' => 0,
            'alergia' => null,
            'fotografias' => 1,
            'fotografiasdelpadre' => 1,
            'carnet' => 1,
            'certificadodeconducta' => 1,
            'created_at' => '2023-11-15 12:28:58',
            'updated_at' => '2023-11-15 12:28:58',
            'ciudad' => 'San Pedro Sula',
            'depto' => 'Cortés',
            'pais' => 'Honduras',
            'escuelaanterior' => 'José Cecilio del Valle',
            'totalhermanos' => 1,
            'medico' => 'Dr. Martínez',
            'telefonoemergencia' => '98003699',
            'bus' => 1,
            'taxi' => 0,
            'conpadre' => 1,
            'solo' => 0,
        ]);

        $response = $this->post('/tablaindex',[
            'id_alumno' => $alumno->id,
            'secretaria' => 0,
            'orientacion' => 1,
            'consej' => 0,
            'tesoreria' => 0,
            'secultimo' => 0,
        ]);


        $this->assertTrue(Consejeria::where('id_alumno',$alumno->id)->first()->orientacion === 1);

    }

    public function test_21_ruta_guardar_la_confirmacion_de_paso_de_matricula_check_consej()
    {
        $user = User::find(1);
        $this->actingAs($user);

        $alumno = Alumno::firstOrCreate(
            [
                'numerodeidentidad' => '0703199600455',
            ],[
            'primernombre' => 'Juan',
            'segundonombre' => 'Antonio',
            'primerapellido' => 'Pérez',
            'segundoapellido' => 'García',
            'fechadenacimiento' => '1995-07-16',
            'genero' => 'masculino',
            'direccion' => 'Barrio La Esperanza',
            'numerodehermanosenicgc' => 1,
            'tiene_alergia' => 0,
            'alergia' => null,
            'fotografias' => 1,
            'fotografiasdelpadre' => 1,
            'carnet' => 1,
            'certificadodeconducta' => 1,
            'created_at' => '2023-11-15 12:28:58',
            'updated_at' => '2023-11-15 12:28:58',
            'ciudad' => 'San Pedro Sula',
            'depto' => 'Cortés',
            'pais' => 'Honduras',
            'escuelaanterior' => 'José Cecilio del Valle',
            'totalhermanos' => 1,
            'medico' => 'Dr. Martínez',
            'telefonoemergencia' => '98003699',
            'bus' => 1,
            'taxi' => 0,
            'conpadre' => 1,
            'solo' => 0,
        ]);

        $response = $this->post('/tablaindex',[
            'id_alumno' => $alumno->id,
            'secretaria' => 0,
            'orientacion' => 0,
            'consej' => 1,
            'tesoreria' => 0,
            'secultimo' => 0,
        ]);


        $this->assertTrue(Consejeria::where('id_alumno',$alumno->id)->first()->consej === 1);

    }

    public function test_22_ruta_guardar_la_confirmacion_de_paso_de_matricula_check_tesoreria()
    {
        $user = User::find(1);
        $this->actingAs($user);

        $alumno = Alumno::firstOrCreate(
            [
                'numerodeidentidad' => '0703199600455',
            ],[
            'primernombre' => 'Juan',
            'segundonombre' => 'Antonio',
            'primerapellido' => 'Pérez',
            'segundoapellido' => 'García',
            'fechadenacimiento' => '1995-07-16',
            'genero' => 'masculino',
            'direccion' => 'Barrio La Esperanza',
            'numerodehermanosenicgc' => 1,
            'tiene_alergia' => 0,
            'alergia' => null,
            'fotografias' => 1,
            'fotografiasdelpadre' => 1,
            'carnet' => 1,
            'certificadodeconducta' => 1,
            'created_at' => '2023-11-15 12:28:58',
            'updated_at' => '2023-11-15 12:28:58',
            'ciudad' => 'San Pedro Sula',
            'depto' => 'Cortés',
            'pais' => 'Honduras',
            'escuelaanterior' => 'José Cecilio del Valle',
            'totalhermanos' => 1,
            'medico' => 'Dr. Martínez',
            'telefonoemergencia' => '98003699',
            'bus' => 1,
            'taxi' => 0,
            'conpadre' => 1,
            'solo' => 0,
        ]);

        $response = $this->post('/tablaindex',[
            'id_alumno' => $alumno->id,
            'secretaria' => 0,
            'orientacion' => 0,
            'consej' => 0,
            'tesoreria' => 1,
            'secultimo' => 0,
        ]);


        $this->assertTrue(Consejeria::where('id_alumno',$alumno->id)->first()->tesoreria === 1);

    }

    public function test_23_ruta_guardar_la_confirmacion_de_paso_de_matricula_check_secultimo()
    {
        $user = User::find(1);
        $this->actingAs($user);

        $alumno = Alumno::firstOrCreate(
            [
                'numerodeidentidad' => '0703199600455',
            ],[
            'primernombre' => 'Juan',
            'segundonombre' => 'Antonio',
            'primerapellido' => 'Pérez',
            'segundoapellido' => 'García',
            'fechadenacimiento' => '1995-07-16',
            'genero' => 'masculino',
            'direccion' => 'Barrio La Esperanza',
            'numerodehermanosenicgc' => 1,
            'tiene_alergia' => 0,
            'alergia' => null,
            'fotografias' => 1,
            'fotografiasdelpadre' => 1,
            'carnet' => 1,
            'certificadodeconducta' => 1,
            'created_at' => '2023-11-15 12:28:58',
            'updated_at' => '2023-11-15 12:28:58',
            'ciudad' => 'San Pedro Sula',
            'depto' => 'Cortés',
            'pais' => 'Honduras',
            'escuelaanterior' => 'José Cecilio del Valle',
            'totalhermanos' => 1,
            'medico' => 'Dr. Martínez',
            'telefonoemergencia' => '98003699',
            'bus' => 1,
            'taxi' => 0,
            'conpadre' => 1,
            'solo' => 0,
        ]);

        $response = $this->post('/tablaindex',[
            'id_alumno' => $alumno->id,
            'secretaria' => 0,
            'orientacion' => 0,
            'consej' => 0,
            'tesoreria' => 0,
            'secultimo' => 1,
        ]);


        $this->assertTrue(Consejeria::where('id_alumno',$alumno->id)->first()->secultimo === 1);

    }

    public function test_24_ruta_guardar_la_confirmacion_de_paso_de_matricula_check_secretaria_en_index()
    {
        $user = User::find(1);
        $this->actingAs($user);

        $alumno = Alumno::firstOrCreate(
            [
                'numerodeidentidad' => '0703199600455',
            ],[
            'primernombre' => 'Juan',
            'segundonombre' => 'Antonio',
            'primerapellido' => 'Pérez',
            'segundoapellido' => 'García',
            'fechadenacimiento' => '1995-07-16',
            'genero' => 'masculino',
            'direccion' => 'Barrio La Esperanza',
            'numerodehermanosenicgc' => 1,
            'tiene_alergia' => 0,
            'alergia' => null,
            'fotografias' => 1,
            'fotografiasdelpadre' => 1,
            'carnet' => 1,
            'certificadodeconducta' => 1,
            'created_at' => '2023-11-15 12:28:58',
            'updated_at' => '2023-11-15 12:28:58',
            'ciudad' => 'San Pedro Sula',
            'depto' => 'Cortés',
            'pais' => 'Honduras',
            'escuelaanterior' => 'José Cecilio del Valle',
            'totalhermanos' => 1,
            'medico' => 'Dr. Martínez',
            'telefonoemergencia' => '98003699',
            'bus' => 1,
            'taxi' => 0,
            'conpadre' => 1,
            'solo' => 0,
        ]);

        $response = $this->post('/tablaindex',[
            'id_alumno' => $alumno->id,
            'secretaria' => 1,
            'orientacion' => 0,
            'consej' => 0,
            'tesoreria' => 0,
            'secultimo' => 0,
        ]);

        $this->actingAs($user);
        $response2 =  $this->get('consjindex/'.$alumno->id);

        $secretariaCheckbox = $response2->getContent();
        $this->assertStringContainsString('id="secretaria" value="1" checked', $secretariaCheckbox);
    }


    public function test_25_ruta_guardar_la_confirmacion_de_paso_de_matricula_check_orientacion_en_index()
    {
        $user = User::find(1);
        $this->actingAs($user);

        $alumno = Alumno::firstOrCreate(
            [
                'numerodeidentidad' => '0703199600455',
            ],[
            'primernombre' => 'Juan',
            'segundonombre' => 'Antonio',
            'primerapellido' => 'Pérez',
            'segundoapellido' => 'García',
            'fechadenacimiento' => '1995-07-16',
            'genero' => 'masculino',
            'direccion' => 'Barrio La Esperanza',
            'numerodehermanosenicgc' => 1,
            'tiene_alergia' => 0,
            'alergia' => null,
            'fotografias' => 1,
            'fotografiasdelpadre' => 1,
            'carnet' => 1,
            'certificadodeconducta' => 1,
            'created_at' => '2023-11-15 12:28:58',
            'updated_at' => '2023-11-15 12:28:58',
            'ciudad' => 'San Pedro Sula',
            'depto' => 'Cortés',
            'pais' => 'Honduras',
            'escuelaanterior' => 'José Cecilio del Valle',
            'totalhermanos' => 1,
            'medico' => 'Dr. Martínez',
            'telefonoemergencia' => '98003699',
            'bus' => 1,
            'taxi' => 0,
            'conpadre' => 1,
            'solo' => 0,
        ]);

        $response = $this->post('/tablaindex',[
            'id_alumno' => $alumno->id,
            'secretaria' => 0,
            'orientacion' => 1,
            'consej' => 0,
            'tesoreria' => 0,
            'secultimo' => 0,
        ]);

        $this->actingAs($user);
        $response2 =  $this->get('consjindex/'.$alumno->id);

        $secretariaCheckbox = $response2->getContent();
        $this->assertStringContainsString('name="orientacion" value="2" checked', $secretariaCheckbox);
    }

    public function test_26_ruta_guardar_la_confirmacion_de_paso_de_matricula_check_consej_en_index()
    {
        $user = User::find(1);
        $this->actingAs($user);

        $alumno = Alumno::firstOrCreate(
            [
                'numerodeidentidad' => '0703199600455',
            ],[
            'primernombre' => 'Juan',
            'segundonombre' => 'Antonio',
            'primerapellido' => 'Pérez',
            'segundoapellido' => 'García',
            'fechadenacimiento' => '1995-07-16',
            'genero' => 'masculino',
            'direccion' => 'Barrio La Esperanza',
            'numerodehermanosenicgc' => 1,
            'tiene_alergia' => 0,
            'alergia' => null,
            'fotografias' => 1,
            'fotografiasdelpadre' => 1,
            'carnet' => 1,
            'certificadodeconducta' => 1,
            'created_at' => '2023-11-15 12:28:58',
            'updated_at' => '2023-11-15 12:28:58',
            'ciudad' => 'San Pedro Sula',
            'depto' => 'Cortés',
            'pais' => 'Honduras',
            'escuelaanterior' => 'José Cecilio del Valle',
            'totalhermanos' => 1,
            'medico' => 'Dr. Martínez',
            'telefonoemergencia' => '98003699',
            'bus' => 1,
            'taxi' => 0,
            'conpadre' => 1,
            'solo' => 0,
        ]);

        $response = $this->post('/tablaindex',[
            'id_alumno' => $alumno->id,
            'secretaria' => 0,
            'orientacion' => 0,
            'consej' => 1,
            'tesoreria' => 0,
            'secultimo' => 0,
        ]);

        $this->actingAs($user);
        $response2 =  $this->get('consjindex/'.$alumno->id);

        $secretariaCheckbox = $response2->getContent();
        $this->assertStringContainsString('name="consej" value="3" checked', $secretariaCheckbox);
    }

    public function test_27_ruta_guardar_la_confirmacion_de_paso_de_matricula_check_tesoreria_en_index()
    {
        $user = User::find(1);
        $this->actingAs($user);

        $alumno = Alumno::firstOrCreate(
            [
                'numerodeidentidad' => '0703199600455',
            ],[
            'primernombre' => 'Juan',
            'segundonombre' => 'Antonio',
            'primerapellido' => 'Pérez',
            'segundoapellido' => 'García',
            'fechadenacimiento' => '1995-07-16',
            'genero' => 'masculino',
            'direccion' => 'Barrio La Esperanza',
            'numerodehermanosenicgc' => 1,
            'tiene_alergia' => 0,
            'alergia' => null,
            'fotografias' => 1,
            'fotografiasdelpadre' => 1,
            'carnet' => 1,
            'certificadodeconducta' => 1,
            'created_at' => '2023-11-15 12:28:58',
            'updated_at' => '2023-11-15 12:28:58',
            'ciudad' => 'San Pedro Sula',
            'depto' => 'Cortés',
            'pais' => 'Honduras',
            'escuelaanterior' => 'José Cecilio del Valle',
            'totalhermanos' => 1,
            'medico' => 'Dr. Martínez',
            'telefonoemergencia' => '98003699',
            'bus' => 1,
            'taxi' => 0,
            'conpadre' => 1,
            'solo' => 0,
        ]);

        $response = $this->post('/tablaindex',[
            'id_alumno' => $alumno->id,
            'secretaria' => 0,
            'orientacion' => 0,
            'consej' => 0,
            'tesoreria' => 1,
            'secultimo' => 0,
        ]);

        $this->actingAs($user);
        $response2 =  $this->get('consjindex/'.$alumno->id);

        $secretariaCheckbox = $response2->getContent();
        $this->assertStringContainsString('name="tesoreria" value="4" checked', $secretariaCheckbox);
    }

    public function test_28_ruta_guardar_la_confirmacion_de_paso_de_matricula_check_secultimo_en_index()
    {
        $user = User::find(1);
        $this->actingAs($user);

        $alumno = Alumno::firstOrCreate(
            [
                'numerodeidentidad' => '0703199600455',
            ],[
            'primernombre' => 'Juan',
            'segundonombre' => 'Antonio',
            'primerapellido' => 'Pérez',
            'segundoapellido' => 'García',
            'fechadenacimiento' => '1995-07-16',
            'genero' => 'masculino',
            'direccion' => 'Barrio La Esperanza',
            'numerodehermanosenicgc' => 1,
            'tiene_alergia' => 0,
            'alergia' => null,
            'fotografias' => 1,
            'fotografiasdelpadre' => 1,
            'carnet' => 1,
            'certificadodeconducta' => 1,
            'created_at' => '2023-11-15 12:28:58',
            'updated_at' => '2023-11-15 12:28:58',
            'ciudad' => 'San Pedro Sula',
            'depto' => 'Cortés',
            'pais' => 'Honduras',
            'escuelaanterior' => 'José Cecilio del Valle',
            'totalhermanos' => 1,
            'medico' => 'Dr. Martínez',
            'telefonoemergencia' => '98003699',
            'bus' => 1,
            'taxi' => 0,
            'conpadre' => 1,
            'solo' => 0,
        ]);

        $response = $this->post('/tablaindex',[
            'id_alumno' => $alumno->id,
            'secretaria' => 0,
            'orientacion' => 0,
            'consej' => 0,
            'tesoreria' => 0,
            'secultimo' => 1,
        ]);

        $this->actingAs($user);
        $response2 =  $this->get('consjindex/'.$alumno->id);

        $secretariaCheckbox = $response2->getContent();
        $this->assertStringContainsString('name="secultimo" value="5" checked', $secretariaCheckbox);
    }

    public function test_29_ruta_guardar_la_confirmacion_de_paso_de_matricula_check_validacion_id_vacio()
    {
        $user = User::find(1);
        $this->actingAs($user);

        $alumno = Alumno::firstOrCreate(
            [
                'numerodeidentidad' => '0703199600455',
            ],[
            'primernombre' => 'Juan',
            'segundonombre' => 'Antonio',
            'primerapellido' => 'Pérez',
            'segundoapellido' => 'García',
            'fechadenacimiento' => '1995-07-16',
            'genero' => 'masculino',
            'direccion' => 'Barrio La Esperanza',
            'numerodehermanosenicgc' => 1,
            'tiene_alergia' => 0,
            'alergia' => null,
            'fotografias' => 1,
            'fotografiasdelpadre' => 1,
            'carnet' => 1,
            'certificadodeconducta' => 1,
            'created_at' => '2023-11-15 12:28:58',
            'updated_at' => '2023-11-15 12:28:58',
            'ciudad' => 'San Pedro Sula',
            'depto' => 'Cortés',
            'pais' => 'Honduras',
            'escuelaanterior' => 'José Cecilio del Valle',
            'totalhermanos' => 1,
            'medico' => 'Dr. Martínez',
            'telefonoemergencia' => '98003699',
            'bus' => 1,
            'taxi' => 0,
            'conpadre' => 1,
            'solo' => 0,
        ]);

        $response = $this->post('/tablaindex',[
            'id_alumno' => '',
            'secretaria' => 1,
            'orientacion' => 1,
            'consej' => 1,
            'tesoreria' => 1,
            'secultimo' => 1,
        ]);

        $response->assertInvalid([
            'id_alumno'  => 'El ID del alumno es obligatorio.'
        ]);
    }

    public function test_30_ruta_guardar_la_confirmacion_de_paso_de_matricula_check_validacion_id_numerido()
    {
        $user = User::find(1);
        $this->actingAs($user);

        $alumno = Alumno::firstOrCreate(
            [
                'numerodeidentidad' => '0703199600455',
            ],[
            'primernombre' => 'Juan',
            'segundonombre' => 'Antonio',
            'primerapellido' => 'Pérez',
            'segundoapellido' => 'García',
            'fechadenacimiento' => '1995-07-16',
            'genero' => 'masculino',
            'direccion' => 'Barrio La Esperanza',
            'numerodehermanosenicgc' => 1,
            'tiene_alergia' => 0,
            'alergia' => null,
            'fotografias' => 1,
            'fotografiasdelpadre' => 1,
            'carnet' => 1,
            'certificadodeconducta' => 1,
            'created_at' => '2023-11-15 12:28:58',
            'updated_at' => '2023-11-15 12:28:58',
            'ciudad' => 'San Pedro Sula',
            'depto' => 'Cortés',
            'pais' => 'Honduras',
            'escuelaanterior' => 'José Cecilio del Valle',
            'totalhermanos' => 1,
            'medico' => 'Dr. Martínez',
            'telefonoemergencia' => '98003699',
            'bus' => 1,
            'taxi' => 0,
            'conpadre' => 1,
            'solo' => 0,
        ]);

        $response = $this->post('/tablaindex',[
            'id_alumno' => 'id',
            'secretaria' => 1,
            'orientacion' => 1,
            'consej' => 1,
            'tesoreria' => 1,
            'secultimo' => 1,
        ]);

        $response->assertInvalid([
            'id_alumno'  => 'El ID del alumno debe ser numérico.'
        ]);
    }


}

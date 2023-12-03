<?php

namespace Tests\Feature;

use App\Models\Grado;
use App\Models\Horario;
use App\Models\Jornada;
use App\Models\Modalidad;
use App\Models\Seccionconfig;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ConfiguracionTest extends TestCase
{
    public function test_1_la_ruta_indexgrado_deberia_retornar_respuesta_302_sin_usuario_logueado()
    {
        $response = $this->get('/indexgrado');
        $response->assertStatus(302);
    }

    public function test_2_la_ruta_indexgrado_deberia_retornar_al_login_sin_usuario_logueado()
    {
        $response = $this->get('/indexgrado');
        $response->assertRedirect('/login');
    }

    public function test_3_la_ruta_indexgrado_deberia_retornar_respuesta_200_usuario_logueado()
    {
        $user = User::find(1);
        $this->actingAs($user);

        $response = $this->get('/indexgrado');
        $response->assertStatus(200);
    }

    public function test_4_la_ruta_indexgrado_deberia_retornar_a_la_vista_usuario_logueado()
    {
        $user = User::find(1);
        $this->actingAs($user);

        $response = $this->get('/indexgrado');
        $response->assertViewIs('configurar.Grado.indexgrado');
    }

    public function test_5_la_ruta_indexgrado_deberia_retornar_a_la_vista_conteniendo_componetes()
    {
        $user = User::find(1);
        $this->actingAs($user);

        $response = $this->get('/indexgrado');

        $response->assertSee('Lista de Grados');
    }

    public function test_6_la_ruta_indexgrado_deberia_retornar_a_la_vista_tabla_index_conteniendo_columna_1()
    {
        $user = User::find(1);
        $this->actingAs($user);
        $response = $this->get('/indexgrado');

        $response->assertSee('Nombre');
    }

    public function test_7_la_ruta_indexgrado_deberia_retornar_a_la_vista_tabla_index_conteniendo_columna_2()
    {
        $user = User::find(1);
        $this->actingAs($user);
        $response = $this->get('/indexgrado');

        $response->assertSee('Descripción');
    }

    public function test_8_la_ruta_indexgrado_deberia_retornar_a_la_vista_tabla_index_conteniendo_columna_3()
    {
        $user = User::find(1);
        $this->actingAs($user);
        $response = $this->get('/indexgrado');

        $response->assertSee('Opciones');
    }

    public function test_9_la_ruta_indexgrado_deberia_retornar_a_la_vista_tabla_index_conteniendo_boton_nuevo()
    {
        $user = User::find(1);
        $this->actingAs($user);
        $response = $this->get('/indexgrado');

        $response->assertSee('Agregar Grado');
    }

    public function test_10_la_ruta_indexgrado_deberia_retornar_a_la_vista_tabla_index_conteniendo_boton_regresar()
    {
        $user = User::find(1);
        $this->actingAs($user);
        $response = $this->get('/indexgrado');

        $response->assertSee('Regresar');
    }

    public function test_11_la_ruta_indexgrado_deberia_retornar_a_la_vista_tabla_index_conteniendo_boton_editar()
    {
        $user = User::find(1);
        $this->actingAs($user);
        $response = $this->get('/indexgrado');

        $response->assertSee('Editar');
    }

    public function test_12_la_ruta_indexgrado_deberia_retornar_a_la_vista_tabla_index_conteniendo_boton_eliminar()
    {
        $user = User::find(1);
        $this->actingAs($user);
        $response = $this->get('/indexgrado');

        $response->assertSee('Eliminar');
    }

    public function test_13_la_ruta_indexgrado_create_deberia_retornar_respuesta_302_sin_usuario_logueado()
    {
        $response = $this->get('/grado/create');
        $response->assertStatus(302);
    }

    public function test_14_la_ruta_indexgrado_create_deberia_retornar_al_login_sin_usuario_logueado()
    {
        $response = $this->get('/grado/create');
        $response->assertRedirect('/login');
    }

    public function test_15_la_ruta_indexgrado_create_deberia_retornar_respuesta_200_usuario_logueado()
    {
        $user = User::find(1);
        $this->actingAs($user);

        $response = $this->get('/grado/create');
        $response->assertStatus(200);
    }

    public function test_16_la_ruta_indexgrado_create_deberia_retornar_a_la_vista_usuario_logueado()
    {
        $user = User::find(1);
        $this->actingAs($user);

        $response = $this->get('/grado/create');
        $response->assertViewIs('configurar.Grado.grado');
    }

    public function test_17_la_ruta_indexgrado_create_deberia_retornar_a_la_vista_conteniendo_componetes()
    {
        $user = User::find(1);
        $this->actingAs($user);

        $response = $this->get('/grado/create');
        $response->assertSee('Grado');
    }


    public function test_18_la_ruta_indexgrado_create_deberia_retornar_a_la_vista_conteniendo_componetes_label_nombre_grado()
    {
        $user = User::find(1);
        $this->actingAs($user);

        $response = $this->get('/grado/create');
        $response->assertSee('Nombre del Grado:');
    }

    public function test_19_la_ruta_indexgrado_create_deberia_retornar_a_la_vista_conteniendo_componetes_label_descripcion()
    {
        $user = User::find(1);
        $this->actingAs($user);

        $response = $this->get('/grado/create');
        $response->assertSee('Descripción:');
    }

    public function test_20_la_ruta_indexgrado_create_deberia_retornar_a_la_vista_conteniendo_componetes_boton_regresar()
    {
        $user = User::find(1);
        $this->actingAs($user);

        $response = $this->get('/grado/create');
        $response->assertSee('Regresar');
    }

    public function test_21_la_ruta_indexgrado_create_deberia_retornar_a_la_vista_conteniendo_componetes_boton_guardar()
    {
        $user = User::find(1);
        $this->actingAs($user);

        $response = $this->get('/grado/create');
        $response->assertSee('Crear Grado');
    }

    public function test_22_la_ruta_grado_store_deberia_crear_el_grado()
    {
        $user = User::find(1);
        $this->actingAs($user);

        $grado = Grado::firstOrCreate(
            [
                'nombre' => 'Primer Grado',
            ],
            [
                'descripcion' => 'ALumnos de la profe melvin',
            ]
        );

        $grado->delete();
        $response = $this->post('/grado', [
            'nombre' => 'Primer Grado',
            'descripcion' => 'ALumnos de la profe melvin',
        ]);

        $ultimoRegistro = Grado::latest()->first();

        $this->assertTrue($ultimoRegistro->nombre == 'Primer Grado');
    }


    public function test_23_la_ruta_grado_store_deberia_crear_el_grado_validaciones_nombre_obligatorio()
    {
        $user = User::find(1);
        $this->actingAs($user);

        $grado = Grado::firstOrCreate(
            [
                'nombre' => 'Primer Grado',
            ],
            [
                'descripcion' => 'ALumnos de la profe melvin',
            ]
        );

        $grado->delete();
        $response = $this->post('/grado', [
            'nombre' => null,
            'descripcion' => 'ALumnos de la profe melvin',
        ]);

        $response->assertInvalid([
            'nombre' => 'El campo nombre es obligatorio.',
        ]);
    }

    public function test_24_la_ruta_grado_store_deberia_crear_el_grado_validaciones_nombre_unico()
    {
        $user = User::find(1);
        $this->actingAs($user);

        $grado = Grado::firstOrCreate(
            [
                'nombre' => 'Primer Grado',
            ],
            [
                'descripcion' => 'ALumnos de la profe melvin',
            ]
        );


        $response = $this->post('/grado', [
            'nombre' => 'Primer Grado',
            'descripcion' => 'ALumnos de la profe melvin',
        ]);

        $grado->delete();

        $response->assertInvalid([
            'nombre' => 'El campo nombre ya existe.',
        ]);
    }

    public function test_25_la_ruta_grado_store_deberia_crear_el_grado_validaciones_descripcion_obligatorio()
    {
        $user = User::find(1);
        $this->actingAs($user);

        $grado = Grado::firstOrCreate(
            [
                'nombre' => 'Primer Grado',
            ],
            [
                'descripcion' => 'ALumnos de la profe melvin',
            ]
        );

        $grado->delete();
        $response = $this->post('/grado', [
            'nombre' => 'Primer Grado',
            'descripcion' => null,
        ]);



        $response->assertInvalid([
            'descripcion' => 'El campo descripción es obligatorio.',
        ]);
    }

    public function test_26_la_ruta_grados_edit_deberia_retornar_respuesta_302_sin_usuario_logueado()
    {
        $grado = Grado::firstOrCreate(
            [
                'nombre' => 'Primer Grado',
            ],
            [
                'descripcion' => 'ALumnos de la profe melvin',
            ]
        );

        $response = $this->get('/grados/' . $grado->id . '/edit');
        $response->assertStatus(302);
    }

    public function test_27_la_ruta_grados_edit_deberia_retornar_al_login_sin_usuario_logueado()
    {
        $grado = Grado::firstOrCreate(
            [
                'nombre' => 'Primer Grado',
            ],
            [
                'descripcion' => 'ALumnos de la profe melvin',
            ]
        );

        $response = $this->get('/grados/' . $grado->id . '/edit');
        $response->assertRedirect('/login');
    }


    public function test_28_la_ruta_grados_edit_deberia_retornar_respuesta_200_usuario_logueado()
    {
        $user = User::find(1);
        $this->actingAs($user);
        $grado = Grado::firstOrCreate(
            [
                'nombre' => 'Primer Grado',
            ],
            [
                'descripcion' => 'ALumnos de la profe melvin',
            ]
        );

        $response = $this->get('/grados/' . $grado->id . '/edit');
        $response->assertStatus(200);
    }

    public function test_29_la_ruta_grados_edit_deberia_retornar_a_la_vista_usuario_logueado()
    {
        $user = User::find(1);
        $this->actingAs($user);
        $grado = Grado::firstOrCreate(
            [
                'nombre' => 'Primer Grado',
            ],
            [
                'descripcion' => 'ALumnos de la profe melvin',
            ]
        );

        $response = $this->get('/grados/' . $grado->id . '/edit');
        $response->assertViewIs('configurar.Grado.editar');
    }

    public function test_30_la_ruta_grados_edit_deberia_retornar_a_la_vista_conteniendo_componetes()
    {
        $user = User::find(1);
        $this->actingAs($user);
        $grado = Grado::firstOrCreate(
            [
                'nombre' => 'Primer Grado',
            ],
            [
                'descripcion' => 'ALumnos de la profe melvin',
            ]
        );

        $response = $this->get('/grados/' . $grado->id . '/edit');
        $response->assertSee('Actualizar Grados');
    }


    public function test_31_la_ruta_grados_edit_deberia_retornar_a_la_vista_conteniendo_componetes_label_nombre_grado()
    {
        $user = User::find(1);
        $this->actingAs($user);

        $grado = Grado::firstOrCreate(
            [
                'nombre' => 'Primer Grado',
            ],
            [
                'descripcion' => 'ALumnos de la profe melvin',
            ]
        );

        $response = $this->get('/grados/' . $grado->id . '/edit');
        $response->assertSee('Nombre');
    }

    public function test_32_la_ruta_grados_edit_deberia_retornar_a_la_vista_conteniendo_componetes_label_descripcion()
    {
        $user = User::find(1);
        $this->actingAs($user);


        $grado = Grado::firstOrCreate(
            [
                'nombre' => 'Primer Grado',
            ],
            [
                'descripcion' => 'ALumnos de la profe melvin',
            ]
        );

        $response = $this->get('/grados/' . $grado->id . '/edit');
        $response->assertSee('Descripción');
    }

    public function test_33_la_ruta_grados_edit_deberia_retornar_a_la_vista_conteniendo_componetes_input_nombre_grado()
    {
        $user = User::find(1);
        $this->actingAs($user);

        $grado = Grado::firstOrCreate(
            [
                'nombre' => 'Primer Grado',
            ],
            [
                'descripcion' => 'ALumnos de la profe melvin',
            ]
        );

        $response = $this->get('/grados/' . $grado->id . '/edit');
        $response->assertSee($grado->nombre);
    }

    public function test_34_la_ruta_grados_edit_deberia_retornar_a_la_vista_conteniendo_componetes_input_descripcion()
    {
        $user = User::find(1);
        $this->actingAs($user);


        $grado = Grado::firstOrCreate(
            [
                'nombre' => 'Primer Grado',
            ],
            [
                'descripcion' => 'Alumnos de la profe melvin',
            ]
        );

        $response = $this->get('/grados/' . $grado->id . '/edit');
        $response->assertSee($grado->descripcion);
    }

    public function test_35_la_ruta_grados_edit_deberia_retornar_a_la_vista_conteniendo_componetes_boton_regresar()
    {
        $user = User::find(1);
        $this->actingAs($user);

        $grado = Grado::firstOrCreate(
            [
                'nombre' => 'Primer Grado',
            ],
            [
                'descripcion' => 'Alumnos de la profe melvin',
            ]
        );

        $response = $this->get('/grados/' . $grado->id . '/edit');
        $response->assertSee('Regresar');
    }

    public function test_36_la_ruta_grados_edit_deberia_retornar_a_la_vista_conteniendo_componetes_boton_guardar()
    {
        $user = User::find(1);
        $this->actingAs($user);

        $grado = Grado::firstOrCreate(
            [
                'nombre' => 'Primer Grado',
            ],
            [
                'descripcion' => 'Alumnos de la profe melvin',
            ]
        );

        $response = $this->get('/grados/' . $grado->id . '/edit');
        $response->assertSee('Guardar cambios');
    }

    public function test_37_la_grados_update_deberia_actualizar_el_grado()
    {
        $user = User::find(1);
        $this->actingAs($user);

        $grado = Grado::firstOrCreate(
            [
                'nombre' => 'Primer Grado',
            ],
            [
                'descripcion' => 'ALumnos de la profe melvin',
            ]
        );

        $response = $this->put('/grados/' . $grado->id, [
            'nombre' => 'Segundo Grado',
            'descripcion' => 'ALumnos de la profe melvin',
        ]);

        $ultimoRegistro = Grado::find($grado->id);
        $grado->delete();

        $this->assertTrue($ultimoRegistro->nombre == 'Segundo Grado');
    }


    public function test_38_la_ruta_grados_update_deberia_actualizar_el_grado_validaciones_nombre_obligatorio()
    {
        $user = User::find(1);
        $this->actingAs($user);

        $grado = Grado::firstOrCreate(
            [
                'nombre' => 'Primer Grado',
            ],
            [
                'descripcion' => 'ALumnos de la profe melvin',
            ]
        );

        $response = $this->put('/grados/' . $grado->id, [
            'nombre' => null,
            'descripcion' => 'ALumnos de la profe melvin',
        ]);

        $response->assertInvalid([
            'nombre' => 'El campo nombre es obligatorio.',
        ]);
    }

    public function test_39_la_ruta_grados_update_deberia_actualizar_el_grado_validaciones_nombre_unico()
    {
        $user = User::find(1);
        $this->actingAs($user);

        $grado = Grado::firstOrCreate(
            [
                'nombre' => 'Primer Grado',
            ],
            [
                'descripcion' => 'ALumnos de la profe melvin',
            ]
        );


        $grado2 = Grado::firstOrCreate(
            [
                'nombre' => 'Segundo Grado',
            ],
            [
                'descripcion' => 'ALumnos de la profe Maria Jose',
            ]
        );



        $response = $this->put('/grados/' . $grado2->id, [
            'nombre' => 'Primer Grado',
            'descripcion' => 'ALumnos de la profe melvin',
        ]);

        $grado2->delete();
        $grado->delete();

        $response->assertInvalid([
            'nombre' => 'El campo nombre ya existe.',
        ]);
    }

    public function test_40_la_ruta_grados_delete_deberia_eliminar_el_grado()
    {
        $user = User::find(1);
        $this->actingAs($user);

        $grado = Grado::firstOrCreate(
            [
                'nombre' => 'Primer Grado',
            ],[
                'descripcion' => 'ALumnos de la profe melvin',
            ]);


            $response = $this->put('/grados/' . $grado->id, [
                'nombre' => 'Primer Grado',
                'descripcion' => null,
            ]);



        $response->assertInvalid([
            'descripcion' => 'El campo descripción es obligatorio.',
        ]);
    }

    public function test_41_la_ruta_grados_update_deberia_actualizar_el_grado_validaciones_descripcion_obligatorio()
    {
        $user = User::find(1);
        $this->actingAs($user);

        $grado = Grado::firstOrCreate(
            [
                'nombre' => 'Primer Grado',
            ],[
                'descripcion' => 'ALumnos de la profe melvin',
            ]);


            $response = $this->delete('/grados/' . $grado->id);



        $response->assertSessionHas('success');
    }


    public function test_42_la_ruta_horarioc_deberia_retornar_respuesta_302_sin_usuario_logueado()
    {
        $response = $this->get('/horarioc');
        $response->assertStatus(302);
    }

    public function test_43_la_ruta_horarioc_deberia_retornar_al_login_sin_usuario_logueado()
    {
        $response = $this->get('/horarioc');
        $response->assertRedirect('/login');
    }

    public function test_44_la_ruta_horarioc_deberia_retornar_respuesta_200_usuario_logueado()
    {
        $user = User::find(1);
        $this->actingAs($user);

        $response = $this->get('/horarioc');
        $response->assertStatus(200);
    }

    public function test_45_la_ruta_horarioc_deberia_retornar_a_la_vista_usuario_logueado()
    {
        $user = User::find(1);
        $this->actingAs($user);

        $response = $this->get('/horarioc');
        $response->assertViewIs('secretaria.Horario.horariolista');
    }

    public function test_46_la_ruta_horarioc_deberia_retornar_a_la_vista_conteniendo_componetes()
    {
        $user = User::find(1);
        $this->actingAs($user);

        $response = $this->get('/horarioc');

        $response->assertSee('Lista de Horarios');
    }

    public function test_47_la_ruta_horarioc_deberia_retornar_a_la_vista_tabla_index_conteniendo_columna_1()
    {
        $user = User::find(1);
        $this->actingAs($user);
        $response = $this->get('/horarioc');

        $response->assertSee('Jornada');
    }

    public function test_48_la_ruta_horarioc_deberia_retornar_a_la_vista_tabla_index_conteniendo_columna_2()
    {
        $user = User::find(1);
        $this->actingAs($user);
        $response = $this->get('/horarioc');

        $response->assertSee('Descripción');
    }

    public function test_49_la_ruta_horarioc_deberia_retornar_a_la_vista_tabla_index_conteniendo_columna_3()
    {
        $user = User::find(1);
        $this->actingAs($user);
        $response = $this->get('/horarioc');

        $response->assertSee('Hora Inicial');
    }

    public function test_50_la_ruta_horarioc_deberia_retornar_a_la_vista_tabla_index_conteniendo_columna_4()
    {
        $user = User::find(1);
        $this->actingAs($user);
        $response = $this->get('/horarioc');

        $response->assertSee('Hora Final');
    }

    public function test_51_la_ruta_horarioc_deberia_retornar_a_la_vista_tabla_index_conteniendo_columna_5()
    {
        $user = User::find(1);
        $this->actingAs($user);
        $response = $this->get('/horarioc');

        $response->assertSee('Opciones');
    }

    public function test_52_la_ruta_horarioc_deberia_retornar_a_la_vista_tabla_index_conteniendo_boton_nuevo()
    {
        $user = User::find(1);
        $this->actingAs($user);
        $response = $this->get('/horarioc');

        $response->assertSee('Agregar Horario');
    }

    public function test_53_la_ruta_horarioc_deberia_retornar_a_la_vista_tabla_index_conteniendo_boton_regresar()
    {
        $user = User::find(1);
        $this->actingAs($user);
        $response = $this->get('/horarioc');

        $response->assertSee('Regresar');
    }

    public function test_54_la_ruta_horarioc_deberia_retornar_a_la_vista_tabla_index_conteniendo_boton_editar()
    {
        $user = User::find(1);
        $this->actingAs($user);
        $grado = Horario::firstOrCreate(
            [
                'jornada' => 'matutina',
            ],
            [
                'descripcion' => 'Mañana',
                'hora_inicio' => '07:00:00',
                'hora_final' => '12:00:00',
            ]
        );
        $response = $this->get('/horarioc');
        $grado->delete();

        $response->assertSee('Editar');
    }

    public function test_55_la_ruta_horarioc_deberia_retornar_a_la_vista_tabla_index_conteniendo_boton_eliminar()
    {
        $user = User::find(1);
        $this->actingAs($user);
        $grado = Horario::firstOrCreate(
            [
                'jornada' => 'matutina',
            ],
            [
                'descripcion' => 'Mañana',
                'hora_inicio' => '07:00:00',
                'hora_final' => '12:00:00',
            ]
        );
        $response = $this->get('/horarioc');
        $grado->delete();

        $response->assertSee('Eliminar');
    }

    public function test_56_la_ruta_horarioc_deberia_retornar_a_la_vista_tabla_index_conteniendo_registro_tabla_col_jornada()
    {
        $user = User::find(1);
        $this->actingAs($user);

        $grado = Horario::firstOrCreate(
            [
                'jornada' => 'matutina',
            ],
            [
                'descripcion' => 'Mañana',
                'hora_inicio' => '07:00:00',
                'hora_final' => '12:00:00',
            ]
        );
        $response = $this->get('/horarioc');
        $grado->delete();

        $response->assertSee('matutina');
    }

    public function test_57_la_ruta_horarioc_deberia_retornar_a_la_vista_tabla_index_conteniendo_registro_tabla_col_descripcion()
    {
        $user = User::find(1);
        $this->actingAs($user);

        $grado = Horario::firstOrCreate(
            [
                'jornada' => 'matutina',
            ],
            [
                'descripcion' => 'Mañana',
                'hora_inicio' => '07:00:00',
                'hora_final' => '12:00:00',
            ]
        );
        $response = $this->get('/horarioc');
        $grado->delete();

        $response->assertSee('Mañana');
    }

    public function test_58_la_ruta_horarioc_deberia_retornar_a_la_vista_tabla_index_conteniendo_registro_tabla_col_hora_inicio()
    {
        $user = User::find(1);
        $this->actingAs($user);

        $grado = Horario::firstOrCreate(
            [
                'jornada' => 'matutina',
            ],
            [
                'descripcion' => 'Mañana',
                'hora_inicio' => '07:00:00',
                'hora_final' => '12:00:00',
            ]
        );
        $response = $this->get('/horarioc');
        $grado->delete();

        $response->assertSee('07:00:00');
    }

    public function test_59_la_ruta_horarioc_deberia_retornar_a_la_vista_tabla_index_conteniendo_registro_tabla_col_hora_final()
    {
        $user = User::find(1);
        $this->actingAs($user);

        $grado = Horario::firstOrCreate(
            [
                'jornada' => 'matutina',
            ],
            [
                'descripcion' => 'Mañana',
                'hora_inicio' => '07:00:00',
                'hora_final' => '12:00:00',
            ]
        );
        $response = $this->get('/horarioc');
        $grado->delete();

        $response->assertSee('12:00:00');
    }

    public function test_60_la_ruta_horarioc_create_deberia_retornar_respuesta_302_sin_usuario_logueado()
    {
        $response = $this->get('/horarioc/create');
        $response->assertStatus(302);
    }

    public function test_61_la_ruta_horarioc_create_deberia_retornar_al_login_sin_usuario_logueado()
    {
        $response = $this->get('/horarioc/create');
        $response->assertRedirect('/login');
    }

    public function test_62_la_ruta_horarioc_create_deberia_retornar_respuesta_200_usuario_logueado()
    {
        $user = User::find(1);
        $this->actingAs($user);

        $response = $this->get('/horarioc/create');
        $response->assertStatus(200);
    }

    public function test_63_la_ruta_horarioc_create_deberia_retornar_a_la_vista_usuario_logueado()
    {
        $user = User::find(1);
        $this->actingAs($user);

        $response = $this->get('/horarioc/create');
        $response->assertViewIs('secretaria.horario.horarioc');
    }

    public function test_64_la_ruta_horarioc_create_deberia_retornar_a_la_vista_conteniendo_componetes()
    {
        $user = User::find(1);
        $this->actingAs($user);

        $response = $this->get('/horarioc/create');
        $response->assertSee('Horario');
    }

    public function test_65_la_ruta_horarioc_create_deberia_retornar_a_la_vista_conteniendo_componetes_label_jornada()
    {
        $user = User::find(1);
        $this->actingAs($user);

        $response = $this->get('/horarioc/create');
        $response->assertSee('Jornada:');
    }

    public function test_66_la_ruta_horarioc_create_deberia_retornar_a_la_vista_conteniendo_componetes_label_descripcion()
    {
        $user = User::find(1);
        $this->actingAs($user);

        $response = $this->get('/horarioc/create');
        $response->assertSee('Descripción:');
    }

    public function test_67_la_ruta_horarioc_create_deberia_retornar_a_la_vista_conteniendo_componetes_label_hora_inicial()
    {
        $user = User::find(1);
        $this->actingAs($user);

        $response = $this->get('/horarioc/create');
        $response->assertSee('Hora Inicial');
    }

    public function test_68_la_ruta_horarioc_create_deberia_retornar_a_la_vista_conteniendo_componetes_label_hora_final()
    {
        $user = User::find(1);
        $this->actingAs($user);

        $response = $this->get('/horarioc/create');
        $response->assertSee('Hora Final');
    }

    public function test_69_la_ruta_horarioc_create_deberia_retornar_a_la_vista_conteniendo_componetes_boton_regresar()
    {
        $user = User::find(1);
        $this->actingAs($user);

        $response = $this->get('/horarioc/create');
        $response->assertSee('Regresar');
    }

    public function test_70_la_ruta_horarioc_create_deberia_retornar_a_la_vista_conteniendo_componetes_boton_guardar()
    {
        $user = User::find(1);
        $this->actingAs($user);

        $response = $this->get('/horarioc/create');
        $response->assertSee('Guardar');
    }

    public function test_71_la_ruta_horarioc_create_deberia_retornar_a_la_vista_conteniendo_componetes_boton_agrega_horario()
    {
        $user = User::find(1);
        $this->actingAs($user);

        $response = $this->get('/horarioc/create');
        $response->assertSee('+ Agregar');
    }

    public function test_72_la_ruta_horarioc_create_deberia_retornar_a_la_vista_conteniendo_componetes_boton_agrega_quitar()
    {
        $user = User::find(1);
        $this->actingAs($user);

        $response = $this->get('/horarioc/create');
        $response->assertSee('Quitar');
    }


    public function test_73_la_ruta_indexJornada_deberia_retornar_respuesta_302_sin_usuario_logueado()
    {
        $response = $this->get('/indexJornada');
        $response->assertStatus(302);
    }

    public function test_74_la_ruta_indexJornada_deberia_retornar_al_login_sin_usuario_logueado()
    {
        $response = $this->get('/indexJornada');
        $response->assertRedirect('/login');
    }

    public function test_75_la_ruta_indexJornada_deberia_retornar_respuesta_200_usuario_logueado()
    {
        $user = User::find(1);
        $this->actingAs($user);

        $response = $this->get('/indexJornada');
        $response->assertStatus(200);
    }

    public function test_76_la_ruta_indexJornada_deberia_retornar_a_la_vista_usuario_logueado()
    {
        $user = User::find(1);
        $this->actingAs($user);

        $response = $this->get('/indexJornada');
        $response->assertViewIs('configurar.Jornada.indexJornada');
    }

    public function test_77_la_ruta_indexJornada_deberia_retornar_a_la_vista_conteniendo_componetes()
    {
        $user = User::find(1);
        $this->actingAs($user);

        $response = $this->get('/indexJornada');

        $response->assertSee('Lista de Jornadas');
    }

    public function test_78_la_ruta_indexJornada_deberia_retornar_a_la_vista_tabla_index_conteniendo_columna_1()
    {
        $user = User::find(1);
        $this->actingAs($user);
        $response = $this->get('/indexJornada');

        $response->assertSee('Jornada');
    }

    public function test_79_la_ruta_indexJornada_deberia_retornar_a_la_vista_tabla_index_conteniendo_columna_2()
    {
        $user = User::find(1);
        $this->actingAs($user);
        $response = $this->get('/indexJornada');

        $response->assertSee('Descripción');
    }

    public function test_80_la_ruta_indexJornada_deberia_retornar_a_la_vista_tabla_index_conteniendo_columna_3()
    {
        $user = User::find(1);
        $this->actingAs($user);
        $response = $this->get('/indexJornada');

        $response->assertSee('Opciones');
    }

    public function test_81_la_ruta_indexJornada_deberia_retornar_a_la_vista_tabla_index_conteniendo_boton_nuevo()
    {
        $user = User::find(1);
        $this->actingAs($user);
        $response = $this->get('/indexJornada');

        $response->assertSee('Agregar Jornada');
    }

    public function test_82_la_ruta_indexJornada_deberia_retornar_a_la_vista_tabla_index_conteniendo_boton_regresar()
    {
        $user = User::find(1);
        $this->actingAs($user);
        $response = $this->get('/indexJornada');

        $response->assertSee('Regresar');
    }

    public function test_83_la_ruta_indexJornada_deberia_retornar_a_la_vista_tabla_index_conteniendo_boton_editar()
    {
        $user = User::find(1);
        $this->actingAs($user);
       Jornada::firstOrCreate(
            [
                'jornada' => 'Vespertina',
            ],
            [
                'descripcion' => 'ALumnos de la profe melvin',
            ]
        );
        $response = $this->get('/indexJornada');

        $response->assertSee('Editar');
    }

    public function test_84_la_ruta_indexJornada_deberia_retornar_a_la_vista_tabla_index_conteniendo_boton_eliminar()
    {
        $user = User::find(1);
        $this->actingAs($user);
        Jornada::firstOrCreate(
            [
                'jornada' => 'Vespertina',
            ],
            [
                'descripcion' => 'ALumnos de la profe melvin',
            ]
        );
        $response = $this->get('/indexJornada');

        $response->assertSee('Eliminar');
    }

    public function test_85_la_ruta_jornada_create_deberia_retornar_respuesta_302_sin_usuario_logueado()
    {
        $response = $this->get('/jornada');
        $response->assertStatus(302);
    }

    public function test_86_la_ruta_jornada_create_deberia_retornar_al_login_sin_usuario_logueado()
    {
        $response = $this->get('/jornada');
        $response->assertRedirect('/login');
    }

    public function test_87_la_ruta_jornada_create_deberia_retornar_respuesta_200_usuario_logueado()
    {
        $user = User::find(1);
        $this->actingAs($user);

        $response = $this->get('/jornada');
        $response->assertStatus(200);
    }

    public function test_88_la_ruta_jornada_create_deberia_retornar_a_la_vista_usuario_logueado()
    {
        $user = User::find(1);
        $this->actingAs($user);

        $response = $this->get('/jornada');
        $response->assertViewIs('configurar.Jornada.jornada');
    }

    public function test_89_la_ruta_jornada_create_deberia_retornar_a_la_vista_conteniendo_componetes()
    {
        $user = User::find(1);
        $this->actingAs($user);

        $response = $this->get('/jornada');
        $response->assertSee('Agregar Nueva Jornada');
    }


    public function test_90_la_ruta_jornada_create_deberia_retornar_a_la_vista_conteniendo_componetes_label_jornada()
    {
        $user = User::find(1);
        $this->actingAs($user);

        $response = $this->get('/jornada');
        $response->assertSee('Jornada');
    }

    public function test_91_la_ruta_jornada_create_deberia_retornar_a_la_vista_conteniendo_componetes_label_descripcion()
    {
        $user = User::find(1);
        $this->actingAs($user);

        $response = $this->get('/jornada');
        $response->assertSee('Descripción');
    }

    public function test_92_la_ruta_jornada_create_deberia_retornar_a_la_vista_conteniendo_componetes_boton_regresar()
    {
        $user = User::find(1);
        $this->actingAs($user);

        $response = $this->get('/jornada');
        $response->assertSee('Regresar');
    }

    public function test_93_la_ruta_jornada_create_deberia_retornar_a_la_vista_conteniendo_componetes_boton_guardar()
    {
        $user = User::find(1);
        $this->actingAs($user);

        $response = $this->get('/jornada');
        $response->assertSee('Guardar');
    }


    public function test_94_la_ruta_jornada_store_deberia_crear_la_jornada()
    {
        $user = User::find(1);
        $this->actingAs($user);

        $jornada = Jornada::firstOrCreate(
            [
                'jornada' => 'Vespertina',
            ],
            [
                'descripcion' => 'ALumnos de la profe melvin',
            ]
        );

        $jornada->delete();
        $response = $this->post('/jornada',[
            'jornada' => 'Vespertina',
            'descripcion' => 'ALumnos de la profe melvin',
        ]);

        $ultimoRegistro = Jornada::latest()->first();

        $this->assertTrue($ultimoRegistro->jornada == 'Vespertina');
    }


    public function test_95_la_ruta_jornada_store_deberia_crear_la_jornada_validaciones_jornada_obligatorio()
    {
        $user = User::find(1);
        $this->actingAs($user);

        $jornada = Jornada::firstOrCreate(
            [
                'jornada' => 'Vespertina',
            ],
            [
                'descripcion' => 'ALumnos de la profe melvin',
            ]
        );

        $jornada->delete();
        $response = $this->post('/jornada',[
            'jornada' => null,
            'descripcion' => 'ALumnos de la profe melvin',
        ]);

        $response->assertInvalid([
            'jornada' => 'El campo jornada es obligatorio.',
        ]);
    }

    public function test_96_la_ruta_jornada_store_deberia_crear_la_jornada_validaciones_jornada_solo_texto()
    {
        $user = User::find(1);
        $this->actingAs($user);

        $jornada = Jornada::firstOrCreate(
            [
                'jornada' => 'Vespertina',
            ],
            [
                'descripcion' => 'ALumnos de la profe melvin',
            ]
        );

        $jornada->delete();
        $response = $this->post('/jornada',[
            'jornada' => 54,
            'descripcion' => 'ALumnos de la profe melvin',
        ]);

        $response->assertInvalid([
            'jornada' => 'El campo jornada debe ser una cadena de texto.',
        ]);
    }

    public function test_97_la_ruta_jornada_store_deberia_crear_la_jornada_validaciones_jornada_max_255()
    {
        $user = User::find(1);
        $this->actingAs($user);

        $jornada = Jornada::firstOrCreate(
            [
                'jornada' => 'Vespertina',
            ],
            [
                'descripcion' => 'ALumnos de la profe melvin',
            ]
        );

        $jornada->delete();
        $response = $this->post('/jornada',[
            'jornada' => 'sdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsd',
            'descripcion' => 'ALumnos de la profe melvin',
        ]);

        $response->assertInvalid([
            'jornada' => 'El campo jornada no debe exceder los 255 caracteres.',
        ]);
    }


    public function test_98_la_ruta_jornada_store_deberia_crear_la_jornada_validaciones_descripcion_obligatorio()
    {
        $user = User::find(1);
        $this->actingAs($user);

        $jornada = Jornada::firstOrCreate(
            [
                'jornada' => 'Vespertina',
            ],
            [
                'descripcion' => 'ALumnos de la profe melvin',
            ]
        );

        $jornada->delete();
        $response = $this->post('/jornada',[
            'jornada' => 'Vespertina',
            'descripcion' => null,
        ]);

        $response->assertInvalid([
            'descripcion' => 'El campo descripcion es obligatorio.',
        ]);
    }

    public function test_99_la_ruta_jornada_store_deberia_crear_la_jornada_validaciones_descripcion_solo_texto()
    {
        $user = User::find(1);
        $this->actingAs($user);

        $jornada = Jornada::firstOrCreate(
            [
                'jornada' => 'Vespertina',
            ],
            [
                'descripcion' => 'ALumnos de la profe melvin',
            ]
        );

        $jornada->delete();
        $response = $this->post('/jornada',[
            'jornada' => 'Vespertina',
            'descripcion' => 56,
        ]);

        $response->assertInvalid([
            'descripcion' => 'El campo descripcion debe ser una cadena de texto.',
        ]);
    }

    public function test_100_la_ruta_jornada_store_deberia_crear_la_jornada_validaciones_descripcion_max_255()
    {
        $user = User::find(1);
        $this->actingAs($user);

        $jornada = Jornada::firstOrCreate(
            [
                'jornada' => 'Vespertina',
            ],
            [
                'descripcion' => 'ALumnos de la profe melvin',
            ]
        );

        $jornada->delete();
        $response = $this->post('/jornada',[
            'jornada' => 'Vespertina',
            'descripcion' => 'sdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsd',
        ]);

        $response->assertInvalid([
            'descripcion' => 'El campo descripcion no debe exceder los 255 caracteres.',
        ]);
    }


    public function test_101_la_ruta_jornada_edit_deberia_retornar_respuesta_302_sin_usuario_logueado()
    {
        $jornada = Jornada::firstOrCreate(
            [
                'jornada' => 'Vespertina',
            ],
            [
                'descripcion' => 'ALumnos de la profe melvin',
            ]
        );

        $response = $this->get('jornada/'. $jornada->id .'/edit' );
        $response->assertStatus(302);
    }

    public function test_102_la_ruta_jornada_edit_deberia_retornar_al_login_sin_usuario_logueado()
    {
        $jornada = Jornada::firstOrCreate(
            [
                'jornada' => 'Vespertina',
            ],
            [
                'descripcion' => 'ALumnos de la profe melvin',
            ]
        );

        $response = $this->get('jornada/'. $jornada->id .'/edit' );
        $response->assertRedirect('/login');
    }


    public function test_103_la_ruta_jornada_edit_deberia_retornar_respuesta_200_usuario_logueado()
    {
        $user = User::find(1);
        $this->actingAs($user);
        $jornada = Jornada::firstOrCreate(
            [
                'jornada' => 'Vespertina',
            ],
            [
                'descripcion' => 'ALumnos de la profe melvin',
            ]
        );

        $response = $this->get('jornada/'. $jornada->id .'/edit' );
        $response->assertStatus(200);
    }

    public function test_104_la_ruta_jornada_edit_deberia_retornar_a_la_vista_usuario_logueado()
    {
        $user = User::find(1);
        $this->actingAs($user);
        $jornada = Jornada::firstOrCreate(
            [
                'jornada' => 'Vespertina',
            ],
            [
                'descripcion' => 'ALumnos de la profe melvin',
            ]
        );

        $response = $this->get('jornada/'. $jornada->id .'/edit' );
        $response->assertViewIs('configurar.Jornada.editar');
    }

    public function test_105_la_ruta_jornada_edit_deberia_retornar_a_la_vista_conteniendo_componetes()
    {
        $user = User::find(1);
        $this->actingAs($user);
        $jornada = Jornada::firstOrCreate(
            [
                'jornada' => 'Vespertina',
            ],
            [
                'descripcion' => 'ALumnos de la profe melvin',
            ]
        );

        $response = $this->get('jornada/'. $jornada->id .'/edit' );
        $response->assertSee('Editar Jornada');
    }


    public function test_106_la_ruta_jornada_edit_deberia_retornar_a_la_vista_conteniendo_componetes_label_nombre()
    {
        $user = User::find(1);
        $this->actingAs($user);

        $jornada = Jornada::firstOrCreate(
            [
                'jornada' => 'Vespertina',
            ],
            [
                'descripcion' => 'ALumnos de la profe melvin',
            ]
        );

        $response = $this->get('jornada/'. $jornada->id .'/edit' );
        $response->assertSee('Jornada');
    }

    public function test_107_la_ruta_jornada_edit_deberia_retornar_a_la_vista_conteniendo_componetes_label_descripcion()
    {
        $user = User::find(1);
        $this->actingAs($user);

        $jornada = Jornada::firstOrCreate(
            [
                'jornada' => 'Vespertina',
            ],
            [
                'descripcion' => 'ALumnos de la profe melvin',
            ]
        );

        $response = $this->get('jornada/'. $jornada->id .'/edit' );
        $response->assertSee('Descripción');
    }

    public function test_108_la_ruta_jornada_edit_deberia_retornar_a_la_vista_conteniendo_componetes_input_jornada()
    {
        $user = User::find(1);
        $this->actingAs($user);

        $jornada = Jornada::firstOrCreate(
            [
                'jornada' => 'Vespertina',
            ],
            [
                'descripcion' => 'ALumnos de la profe melvin',
            ]
        );

        $response = $this->get('jornada/'. $jornada->id .'/edit' );
        $response->assertSee($jornada->jornada);
    }

    public function test_109_la_ruta_jornada_edit_deberia_retornar_a_la_vista_conteniendo_componetes_input_descripcion()
    {
        $user = User::find(1);
        $this->actingAs($user);

        $jornada = Jornada::firstOrCreate(
            [
                'jornada' => 'Vespertina',
            ],
            [
                'descripcion' => 'ALumnos de la profe melvin',
            ]
        );

        $response = $this->get('jornada/'. $jornada->id .'/edit' );
        $response->assertSee($jornada->descripcion);
    }

    public function test_110_la_ruta_jornada_edit_deberia_retornar_a_la_vista_conteniendo_componetes_boton_regresar()
    {
        $user = User::find(1);
        $this->actingAs($user);

        $jornada = Jornada::firstOrCreate(
            [
                'jornada' => 'Vespertina',
            ],
            [
                'descripcion' => 'ALumnos de la profe melvin',
            ]
        );

        $response = $this->get('jornada/'. $jornada->id .'/edit' );
        $response->assertSee('Regresar');
    }

    public function test_111_la_ruta_jornada_edit_deberia_retornar_a_la_vista_conteniendo_componetes_boton_guardar()
    {
        $user = User::find(1);
        $this->actingAs($user);

        $jornada = Jornada::firstOrCreate(
            [
                'jornada' => 'Vespertina',
            ],
            [
                'descripcion' => 'ALumnos de la profe melvin',
            ]
        );

        $response = $this->get('jornada/'. $jornada->id .'/edit' );
        $response->assertSee('Guardar cambios');
    }


    public function test_112_la_ruta_jornada_update_deberia_actualizar_la_jornada_validaciones_jornada_obligatorio()
    {
        $user = User::find(1);
        $this->actingAs($user);

        $jornada = Jornada::firstOrCreate(
            [
                'jornada' => 'Vespertina',
            ],
            [
                'descripcion' => 'ALumnos de la profe melvin',
            ]
        );


        $response = $this->put('/jornada/'.$jornada->id,[
            'jornada' => null,
            'descripcion' => 'ALumnos de la profe melvin',
        ]);

        $jornada->delete();

        $response->assertInvalid([
            'jornada' => 'El campo jornada es obligatorio.',
        ]);
    }

    public function test_113_la_ruta_jornada_update_deberia_actualizar_la_jornada_validaciones_jornada_solo_texto()
    {
        $user = User::find(1);
        $this->actingAs($user);

        $jornada = Jornada::firstOrCreate(
            [
                'jornada' => 'Vespertina',
            ],
            [
                'descripcion' => 'ALumnos de la profe melvin',
            ]
        );


        $response = $this->put('/jornada/'.$jornada->id,[
            'jornada' => 858,
            'descripcion' => 'ALumnos de la profe melvin',
        ]);

        $jornada->delete();
        $response->assertInvalid([
            'jornada' => 'El campo jornada debe ser una cadena de texto.',
        ]);
    }

    public function test_114_la_ruta_jornada_update_deberia_actualizar_la_jornada_validaciones_jornada_max_255()
    {
        $user = User::find(1);
        $this->actingAs($user);

        $jornada = Jornada::firstOrCreate(
            [
                'jornada' => 'Vespertina',
            ],
            [
                'descripcion' => 'ALumnos de la profe melvin',
            ]
        );


        $response = $this->put('/jornada/'.$jornada->id,[
            'jornada' => 'sdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsd',
            'descripcion' => 'ALumnos de la profe melvin',
        ]);

        $jornada->delete();

        $response->assertInvalid([
            'jornada' => 'El campo jornada no debe exceder los 255 caracteres.',
        ]);
    }


    public function test_115_la_ruta_jornada_update_deberia_actualizar_la_jornada_validaciones_descripcion_obligatorio()
    {
        $user = User::find(1);
        $this->actingAs($user);

        $jornada = Jornada::firstOrCreate(
            [
                'jornada' => 'Vespertina',
            ],
            [
                'descripcion' => 'ALumnos de la profe melvin',
            ]
        );

        $jornada = Jornada::firstOrCreate(
            [
                'jornada' => 'Vespertina',
            ],
            [
                'descripcion' => 'ALumnos de la profe melvin',
            ]
        );


        $response = $this->put('/jornada/'.$jornada->id,[
            'jornada' => 'Vespertina',
            'descripcion' => null,
        ]);

        $jornada->delete();

        $response->assertInvalid([
            'descripcion' => 'El campo descripcion es obligatorio.',
        ]);
    }

    public function test_116_la_ruta_jornada_update_deberia_actualizar_la_jornada_validaciones_descripcion_solo_texto()
    {
        $user = User::find(1);
        $this->actingAs($user);

        $jornada = Jornada::firstOrCreate(
            [
                'jornada' => 'Vespertina',
            ],
            [
                'descripcion' => 'ALumnos de la profe melvin',
            ]
        );

        $jornada = Jornada::firstOrCreate(
            [
                'jornada' => 'Vespertina',
            ],
            [
                'descripcion' => 'ALumnos de la profe melvin',
            ]
        );


        $response = $this->put('/jornada/'.$jornada->id,[
            'jornada' => 'Vespertina',
            'descripcion' => 56,
        ]);

        $jornada->delete();

        $response->assertInvalid([
            'descripcion' => 'El campo descripcion debe ser una cadena de texto.',
        ]);
    }

    public function test_117_la_ruta_jornada_update_deberia_actualizar_la_jornada_validaciones_descripcion_max_255()
    {
        $user = User::find(1);
        $this->actingAs($user);

        $jornada = Jornada::firstOrCreate(
            [
                'jornada' => 'Vespertina',
            ],
            [
                'descripcion' => 'ALumnos de la profe melvin',
            ]
        );


        $response = $this->put('/jornada/'.$jornada->id,[
            'jornada' => 'Vespertina',
            'descripcion' => 'sdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsdsdjhkasduykljalksjdlkajsd',
        ]);

        $jornada->delete();

        $response->assertInvalid([
            'descripcion' => 'El campo descripcion no debe exceder los 255 caracteres.',
        ]);
    }




    public function test_118_la_ruta_modalidadIndex_deberia_retornar_respuesta_302_sin_usuario_logueado()
    {
        $response = $this->get('/modalidadIndex');
        $response->assertStatus(302);
    }

    public function test_119_la_ruta_modalidadIndex_deberia_retornar_al_login_sin_usuario_logueado()
    {
        $response = $this->get('/modalidadIndex');
        $response->assertRedirect('/login');
    }

    public function test_120_la_ruta_modalidadIndex_deberia_retornar_respuesta_200_usuario_logueado()
    {
        $user = User::find(1);
        $this->actingAs($user);

        $response = $this->get('/modalidadIndex');
        $response->assertStatus(200);
    }


}

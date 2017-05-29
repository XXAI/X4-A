<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::post('obtener-token',    'AutenticacionController@autenticar');
Route::post('refresh-token',    'AutenticacionController@refreshToken');
Route::get('check-token',       'AutenticacionController@verificar');

Route::group(['middleware' => 'jwt'], function () {
    Route::resource('usuarios', 'UsuarioController',    ['only' => ['index', 'show', 'store','update','destroy']]);
    Route::resource('roles', 'RolController',           ['only' => ['index', 'show', 'store','update','destroy']]);
    Route::resource('permisos', 'PermisoController',    ['only' => ['index', 'show', 'store','update','destroy']]);
    

    Route::resource('unidades-medicas', 'UnidadesMedicasController',    ['only' => ['index']]);
    
    Route::resource('paciente', 'PacienteController',    ['only' => ['index', 'show', 'store','update','destroy']]);
    Route::resource('paciente-egreso', 'PacienteEgresoController',    ['only' => ['index', 'show', 'store','update','destroy']]);
    //Route::resource('ingreso', 'IngresoController',    ['only' => ['index', 'show', 'store','update','destroy']]);
    Route::resource('admision', 'AdmisionController',    ['only' => ['index', 'show', 'store','update','destroy']]);
    Route::resource('egreso', 'EgresoController',    ['only' => ['index', 'show', 'store','update','destroy']]);
    Route::resource('historial', 'HistorialController',    ['only' => ['show']]);
    //Route::resource('traslado', 'TrasladoController',    ['only' => ['index', 'show', 'store','update','destroy']]);
    
    /*Catálogos*/
    Route::resource('municipio', 'MunicipioController',    ['only' => ['index', 'show']]);
    Route::resource('localidad', 'LocalidadController',    ['only' => ['index', 'show']]);
    Route::resource('motivo-egreso', 'MotivoEgresoController',    ['only' => ['index', 'show']]);
    Route::resource('triage', 'TriageController',    ['only' => ['index', 'show']]);
    Route::resource('grado-lesion', 'GradoLesionController',    ['only' => ['index', 'show']]);
    /*Fin catalogos*/
    
    Route::group(['prefix' => 'sync','namespace' => 'Sync'], function () {
        Route::get('manual',    'SincronizacionController@manual');        
        Route::get('auto',      'SincronizacionController@auto');
        Route::post('importar', 'SincronizacionController@importarSync');
        Route::post('confirmar', 'SincronizacionController@confirmarSync');
    });
    
});

<?php

use App\Http\Controllers\HomeController;
use App\Utils\RolesNames;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;


/*
|---------------------------------------------------------------------------
| Web Routes
|---------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', function () {
    return view('auth.login');
});

//Ver imagen
Route::get('storage/{filename?}', function ($filename  = null) {
    try {
        if (!empty($filename)) {
            $path = storage_path('app/' . "public/documents" . "/" . $filename);
            if (!File::exists($path)) {
                return false;
            }
            $file = File::get($path);
            $type = File::mimeType($path);
            $response = Response::make($file, 200);
            $response->header("Content-Type", $type);
            return $response;
        }
    } catch (Throwable $e) {
    }
})->name('storage');


Route::middleware(['auth'])->group(function () {

     Route::get('/home',[HomeController::class,'index']);

    Route::namespace('App\Http\Controllers\InformePartesMagnetica')->prefix('informe-partes-magneticas')
        ->name('informe-partes-magneticas.')->group(function () {
            Route::get('/index', 'PageController@index')->name('index');
            Route::get('/edit/{id}', 'PageController@edit')->name('edit');
            Route::get('/show/{id}', 'PageController@show')->name('show');
            Route::get('/create', 'PageController@create')->name('create');
            Route::post('/store', 'PageController@store')->name('store');
            Route::patch('/update/{id}', 'PageController@update')->name('update');
            Route::post('/destroy/{id}', 'PageController@destroy')->name('destroy');
        });

    Route::namespace('App\Http\Controllers\InformeLiquidoPenetrante')->prefix('informe-liquidos-penetrante')
        ->name('informe-liquidos-penetrante.')->group(function () {
            Route::get('/index', 'PageController@index')->name('index');
            Route::get('/edit/{id}', 'PageController@edit')->name('edit');
            Route::get('/show/{id}', 'PageController@show')->name('show');
            Route::get('/create', 'PageController@create')->name('create');
            Route::post('/store', 'PageController@store')->name('store');
            Route::patch('/update/{id}', 'PageController@update')->name('update');
            Route::post('/destroy/{id}', 'PageController@destroy')->name('destroy');
        });

    Route::namespace('App\Http\Controllers\InformeUltrasonido')->prefix('informe-ultrasonido')
        ->name('informe-ultrasonido.')->group(function () {
            Route::get('/index', 'PageController@index')->name('index');
            Route::get('/edit/{id}', 'PageController@edit')->name('edit');
            Route::get('/show/{id}', 'PageController@show')->name('show');
            Route::get('/create', 'PageController@create')->name('create');
            Route::post('/store', 'PageController@store')->name('store');
            Route::patch('/update/{id}', 'PageController@update')->name('update');
            Route::post('/destroy/{id}', 'PageController@destroy')->name('destroy');
        });

    Route::namespace('App\Http\Controllers\InformeVertMetalica')->prefix('informe-vert-metalica')
        ->name('informe-vert-metalica.')->group(function () {
            Route::get('/index', 'PageController@index')->name('index');
            Route::get('/edit/{id}', 'PageController@edit')->name('edit');
            Route::get('/show/{id}', 'PageController@show')->name('show');
            Route::get('/create', 'PageController@create')->name('create');
            Route::post('/store', 'PageController@store')->name('store');
            Route::patch('/update/{id}', 'PageController@update')->name('update');
            Route::put('/destroy/{id}', 'PageController@destroy')->name('destroy');
        });

    Route::namespace('App\Http\Controllers\JuntasInformeLiquidosPenetrante')->prefix('juntas-informe-liquidos-penetrantes')
        ->name('juntas-informe-liquidos-penetrantes.')->group(function () {
            Route::get('/index', 'PageController@index')->name('index');
            Route::get('/edit/{id}', 'PageController@edit')->name('edit');
            Route::get('/show/{id}', 'PageController@show')->name('show');
            Route::get('/create', 'PageController@create')->name('create');
            Route::post('/store', 'PageController@store')->name('store');
            Route::patch('/update/{id}', 'PageController@update')->name('update');
            Route::post('/destroy/{id}', 'PageController@destroy')->name('destroy');

            Route::get('/api_getById/{id}', 'PageController@api_getById')->name('api_getById');
            Route::get('/api_getByInfLiquidosPenetrantes/{id}', 'PageController@api_getByInfLiquidosPenetrantes')->name('api_getByInfLiquidosPenetrantes');
            Route::post('/api_add_update', 'PageController@api_add_update')->name('api_add_update');
            Route::post('/api_add', 'PageController@api_add')->name('api_add');
            Route::post('/api_update', 'PageController@api_update')->name('api_update');
            Route::post('/api_delete/{id}', 'PageController@api_delete')->name('api_delete');
        });

    Route::namespace('App\Http\Controllers\JuntasInformePartesMagneticas')->prefix('juntas-informe-partes-magneticas')
        ->name('juntas-informe-partes-magneticas.')->group(function () {
            Route::get('/index', 'PageController@index')->name('index');
            Route::get('/edit/{id}', 'PageController@edit')->name('edit');
            Route::get('/show/{id}', 'PageController@show')->name('show');
            Route::get('/create', 'PageController@create')->name('create');
            Route::post('/store', 'PageController@store')->name('store');
            Route::patch('/update/{id}', 'PageController@update')->name('update');
            Route::post('/destroy/{id}', 'PageController@destroy')->name('destroy');

            Route::get('/api_getById/{id}', 'PageController@api_getById')->name('api_getById');
            Route::get('/api_getByInfParticulaMagnetica/{id}', 'PageController@api_getByInfParticulaMagnetica')->name('api_getByInfParticulaMagnetica');
            Route::post('/api_add_update', 'PageController@api_add_update')->name('api_add_update');
            Route::post('/api_add', 'PageController@api_add')->name('api_add');
            Route::post('/api_update', 'PageController@api_update')->name('api_update');
            Route::post('/api_delete/{id}', 'PageController@api_delete')->name('api_delete');
        });

    Route::namespace('App\Http\Controllers\JuntasInformeUltrasonido')->prefix('juntas-informe-ultrasonido')
        ->name('juntas-informe-ultrasonido.')->group(function () {
            Route::get('/index', 'PageController@index')->name('index');
            Route::get('/edit/{id}', 'PageController@edit')->name('edit');
            Route::get('/show/{id}', 'PageController@show')->name('show');
            Route::get('/create', 'PageController@create')->name('create');
            Route::post('/store', 'PageController@store')->name('store');
            Route::patch('/update/{id}', 'PageController@update')->name('update');
            Route::post('/destroy/{id}', 'PageController@destroy')->name('destroy');

            Route::get('/api_getById/{id}', 'PageController@api_getById')->name('api_getById');
            Route::get('/api_getByInformeId/{id}', 'PageController@api_getByInformeId')->name('api_getByInformeId');
            Route::post('/api_add_update', 'PageController@api_add_update')->name('api_add_update');
            Route::post('/api_add', 'PageController@api_add')->name('api_add');
            Route::post('/api_update', 'PageController@api_update')->name('api_update');
            Route::post('/api_delete/{id}', 'PageController@api_delete')->name('api_delete');
        });

    Route::namespace('App\Http\Controllers\JuntasInformeVertMetalica')->prefix('juntas-informe-vert-metalica')
        ->name('juntas-informe-vert-metalica.')->group(function () {
            Route::get('/index', 'PageController@index')->name('index');
            Route::get('/edit/{id}', 'PageController@edit')->name('edit');
            Route::get('/show/{id}', 'PageController@show')->name('show');
            Route::get('/create', 'PageController@create')->name('create');
            Route::post('/store', 'PageController@store')->name('store');
            Route::patch('/update/{id}', 'PageController@update')->name('update');
            Route::post('/destroy/{id}', 'PageController@destroy')->name('destroy');

            Route::get('/api_getById/{id}', 'PageController@api_getById')->name('api_getById');
            Route::get('/api_getByInfVertMetalica/{id}', 'PageController@api_getByInfVertMetalica')->name('api_getByInfVertMetalica');
            Route::post('/api_add_update', 'PageController@api_add_update')->name('api_add_update');
            Route::post('/api_add', 'PageController@api_add')->name('api_add');
            Route::post('/api_update', 'PageController@api_update')->name('api_update');
            Route::post('/api_delete/{id}', 'PageController@api_delete')->name('api_delete');
        });

        Route::namespace('App\Http\Controllers\DatosJuntasInformeUltrasonido')->prefix('datos-juntas-informe-ultrasonido')
        ->name('datos-juntas-informe-ultrasonido.')->group(function () {
            Route::get('/index', 'PageController@index')->name('index');
            Route::get('/edit/{id}', 'PageController@edit')->name('edit');
            Route::get('/show/{id}', 'PageController@show')->name('show');
            Route::get('/create', 'PageController@create')->name('create');
            Route::post('/store', 'PageController@store')->name('store');
            Route::patch('/update/{id}', 'PageController@update')->name('update');
            Route::post('/destroy/{id}', 'PageController@destroy')->name('destroy');

            Route::get('/api_getById/{id}', 'PageController@api_getById')->name('api_getById');
            Route::get('/api_getByJuntaId/{id}', 'PageController@api_getByJuntaId')->name('api_getByJuntaId');
            Route::post('/api_add_update', 'PageController@api_add_update')->name('api_add_update');
            Route::post('/api_add', 'PageController@api_add')->name('api_add');
            Route::post('/api_update', 'PageController@api_update')->name('api_update');
            Route::post('/api_delete/{id}', 'PageController@api_delete')->name('api_delete');
        });

    Route::namespace('App\Http\Controllers\Reportes')->prefix('reportes-pdf')
        ->name('reportes-pdf.')->group(function () {
            Route::get('/partes-magneticas/{id}', 'PageController@partes_magneticas')->name('partes-magneticas');
            Route::get('/liquidos-penetrante/{id}', 'PageController@liquidos_penetrante')->name('liquidos-penetrante');
            Route::get('/ultrasonido/{id}', 'PageController@ultrasonido')->name('ultrasonido');
            Route::get('/vert-metalica/{id}', 'PageController@ver_metalica')->name('vert-metalica');
        });

    // Route::namespace('App\Http\Controllers')->prefix('home')
    //     ->name('home.')->group(function () {
    //         // Route::get('/', 'HomeController@index')->name('index');
    //         Route::get('/inicio', 'HomeController@inicio')->name('inicio');
    //     });

    Route::namespace('App\Http\Controllers\InformePartesMagnetica')->prefix('home')
        ->name('home.')->group(function () {
            // Route::get('/', 'HomeController@index')->name('index');
            Route::get('/index', 'PageController@index')->name('index');
        });

    Route::namespace('App\Http\Controllers\Admin')->prefix('admin')
    ->middleware(['role:' . RolesNames::$administrador])
        ->name('admin.')->group(function () {
            // Route::get('/', 'PageController@index')->name('index');
            Route::get('/list_users', 'PageController@list_users')->name('list_users');
            Route::get('/edit_user/{id}', 'PageController@edit_user')->name('edit_user');
            Route::get('/create_user', 'PageController@create_user')->name('create_user');
            Route::post('/store_user', 'PageController@store_user')->name('store_user');
            Route::patch('/update_user/{id}', 'PageController@update_user')->name('update_user');
            Route::get('/disable_user/{id}', 'PageController@disable_user')->name('disable_user');
            Route::get('/enable_user/{id}', 'PageController@enable_user')->name('enable_user');
            Route::get('/delete_user/{id}', 'PageController@delete_user')->name('delete_user');            
            Route::get('/edit_password/{id}', 'PageController@edit_password')->name('edit_password');
            Route::patch('/change_password/{id}', 'PageController@change_password')->name('change_password');
        });

    Route::namespace('App\Http\Controllers\ProfileUser')->prefix('profile_user')
        ->name('profile_user.')->group(function () {
            Route::get('/data_profile', 'PageController@data_profile')->name('data_profile');
            Route::post('/update_data_profile', 'PageController@update_data_profile')->name('update_data_profile');
            Route::get('/change_password', 'PageController@change_password')->name('change_password');
            Route::post('/update_password', 'PageController@update_password')->name('update_password');
            Route::post('/update_signature_image', 'PageController@update_signature_image')->name('update_signature_image');
        });

        Route::namespace('App\Http\Controllers\JuntasLiquidosPenetrantesImagenes')->prefix('juntas-liquidos-penetrantes-imagenes')
        ->name('juntas-liquidos-penetrantes-imagenes.')->group(function () {
            Route::get('/api_getById/{id}', 'PageController@api_getById')->name('api_getById');
            Route::get('/api_getByIdJunta/{id}', 'PageController@api_getByIdJunta')->name('api_getByIdJunta');
            Route::post('/api_add_update', 'PageController@api_add_update')->name('api_add_update');
            Route::post('/api_add', 'PageController@api_add')->name('api_add');
            Route::post('/api_update', 'PageController@api_update')->name('api_update');
            Route::post('/api_delete/{id}', 'PageController@api_delete')->name('api_delete');
        });

        Route::namespace('App\Http\Controllers\JuntasPartesMagneticasImagenes')->prefix('juntas-partes-magneticas-imagenes')
        ->name('juntas-partes-magneticas-imagenes.')->group(function () {
            Route::get('/api_getById/{id}', 'PageController@api_getById')->name('api_getById');
            Route::get('/api_getByIdJunta/{id}', 'PageController@api_getByIdJunta')->name('api_getByIdJunta');
            Route::post('/api_add_update', 'PageController@api_add_update')->name('api_add_update');
            Route::post('/api_add', 'PageController@api_add')->name('api_add');
            Route::post('/api_update', 'PageController@api_update')->name('api_update');
            Route::post('/api_delete/{id}', 'PageController@api_delete')->name('api_delete');
        });

    // Route::namespace('App\Http\Controllers\FileAdmin')->prefix('file_admin')
    //     ->name('file_admin.')->group(function () {
    //         Route::get('/getByIdJunta/{id_junta}', 'PageController@getByIdJunta')->name('getByIdJunta');
    //         Route::post('/store-file', 'PageController@store')->name('store-file');
    //     });



});


<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CentroF_Controller;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [CentroF_Controller::class, 'index']);

Route::get('/dashboard', [CentroF_Controller::class, 'panel']);

Route::get('/inscricoes', [CentroF_Controller::class,'inscricoes']);

Route::get('/cursos', [CentroF_Controller::class, 'cursos']);

Route::get('/docentes', [CentroF_Controller::class,'docentes']);

Route::get('/alunos', [CentroF_Controller::class, 'alunos']);

Route::get('/financas', [CentroF_Controller::class, 'financas']);

Route::get('/relatorios', [CentroF_Controller::class, 'relatorios']);
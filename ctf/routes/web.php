<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CentroF_Controller;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [CentroF_Controller::class, 'dashboard']);
Route::get('/dashboard', [CentroF_Controller::class, 'dashboard']);

Route::get('/cursos', [CentroF_Controller::class, 'cursos']);
Route::get('/turmas', [CentroF_Controller::class, 'turmas']);
Route::get('/docentes', [CentroF_Controller::class, 'docentes']);

Route::get('/inscricoes', [CentroF_Controller::class, 'inscricoes']);
Route::get('/formandos', [CentroF_Controller::class, 'formandos']);
Route::get('/alunos', [CentroF_Controller::class, 'formandos']);
Route::get('/matriculas', [CentroF_Controller::class, 'matriculas']);

Route::get('/certificacoes', [CentroF_Controller::class, 'certificacoes']);
Route::get('/relatorios', [CentroF_Controller::class, 'relatorios']);
Route::get('/definicoes', [CentroF_Controller::class, 'definicoes']);
Route::get('/login', [CentroF_Controller::class, 'login']);
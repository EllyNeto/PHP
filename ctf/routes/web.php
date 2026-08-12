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
Route::get('/financas', [CentroF_Controller::class, 'financas'])->name('financas.index');
Route::post('/financas', [CentroF_Controller::class, 'storePagamento'])->name('financas.store');
Route::delete('/financas/{id}', [CentroF_Controller::class, 'destroyPagamento'])->name('financas.destroy');
Route::post('/financas/{id}/delete', [CentroF_Controller::class, 'destroyPagamento']);

Route::get('/inscricoes', [CentroF_Controller::class, 'inscricoes'])->name('inscricoes.index');
Route::post('/inscricoes', [CentroF_Controller::class, 'storeInscriptions'])->name('inscricoes.store');
Route::put('/inscricoes/{id}', [CentroF_Controller::class, 'updateInscription'])->name('inscricoes.update');
Route::post('/inscricoes/{id}', [CentroF_Controller::class, 'updateInscription']);
Route::delete('/inscricoes/{id}', [CentroF_Controller::class, 'destroyInscription'])->name('inscricoes.destroy');
Route::post('/inscricoes/{id}/delete', [CentroF_Controller::class, 'destroyInscription']);
Route::get('/formandos', [CentroF_Controller::class, 'formandos']);
Route::get('/alunos', [CentroF_Controller::class, 'formandos']);
Route::get('/matriculas', [CentroF_Controller::class, 'matriculas']);

Route::get('/certificacoes', [CentroF_Controller::class, 'certificacoes']);
Route::get('/relatorios', [CentroF_Controller::class, 'relatorios']);
Route::get('/definicoes', [CentroF_Controller::class, 'definicoes']);
Route::get('/login', [CentroF_Controller::class, 'login']);
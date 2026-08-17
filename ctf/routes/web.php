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

Route::get('/cursos', [CentroF_Controller::class, 'cursos'])->name('cursos.index');
Route::post('/cursos', [CentroF_Controller::class, 'storeCourse'])->name('cursos.store');
Route::put('/cursos/{id}', [CentroF_Controller::class, 'updateCourse'])->name('cursos.update');
Route::post('/cursos/{id}', [CentroF_Controller::class, 'updateCourse']);
Route::delete('/cursos/{id}', [CentroF_Controller::class, 'destroyCourse'])->name('cursos.destroy');
Route::post('/cursos/{id}/delete', [CentroF_Controller::class, 'destroyCourse']);
Route::get('/turmas', [CentroF_Controller::class, 'turmas'])->name('turmas.index');
Route::post('/turmas', [CentroF_Controller::class, 'storeTurma'])->name('turmas.store');
Route::put('/turmas/{id}', [CentroF_Controller::class, 'updateTurma'])->name('turmas.update');
Route::post('/turmas/{id}', [CentroF_Controller::class, 'updateTurma']);
Route::delete('/turmas/{id}', [CentroF_Controller::class, 'destroyTurma'])->name('turmas.destroy');
Route::post('/turmas/{id}/delete', [CentroF_Controller::class, 'destroyTurma']);
Route::get('/formadores', [CentroF_Controller::class, 'formadores'])->name('formadores.index');
Route::post('/formadores', [CentroF_Controller::class, 'storeFormador'])->name('formadores.store');
Route::put('/formadores/{id}', [CentroF_Controller::class, 'updateFormador'])->name('formadores.update');
Route::post('/formadores/{id}', [CentroF_Controller::class, 'updateFormador']);
Route::delete('/formadores/{id}', [CentroF_Controller::class, 'destroyFormador'])->name('formadores.destroy');
Route::post('/formadores/{id}/delete', [CentroF_Controller::class, 'destroyFormador']);
Route::get('/docentes', [CentroF_Controller::class, 'formadores']);
Route::get('/financas', [CentroF_Controller::class, 'financas'])->name('financas.index');
Route::post('/financas', [CentroF_Controller::class, 'storePagamento'])->name('financas.store');
Route::put('/financas/{id}', [CentroF_Controller::class, 'updatePagamento'])->name('financas.update');
Route::post('/financas/{id}', [CentroF_Controller::class, 'updatePagamento']);
Route::delete('/financas/{id}', [CentroF_Controller::class, 'destroyPagamento'])->name('financas.destroy');
Route::post('/financas/{id}/delete', [CentroF_Controller::class, 'destroyPagamento']);

Route::get('/inscricoes', [CentroF_Controller::class, 'inscricoes'])->name('inscricoes.index');
Route::post('/inscricoes', [CentroF_Controller::class, 'storeInscriptions'])->name('inscricoes.store');
Route::put('/inscricoes/{id}', [CentroF_Controller::class, 'updateInscription'])->name('inscricoes.update');
Route::post('/inscricoes/{id}', [CentroF_Controller::class, 'updateInscription']);
Route::delete('/inscricoes/{id}', [CentroF_Controller::class, 'destroyInscription'])->name('inscricoes.destroy');
Route::post('/inscricoes/{id}/delete', [CentroF_Controller::class, 'destroyInscription']);
Route::get('/formandos', [CentroF_Controller::class, 'formandos'])->name('formandos.index');
Route::get('/alunos', [CentroF_Controller::class, 'formandos']);
Route::post('/formandos', [CentroF_Controller::class, 'storeMatricula'])->name('formandos.store');
Route::put('/formandos/{id}', [CentroF_Controller::class, 'updateMatricula'])->name('formandos.update');
Route::post('/formandos/{id}', [CentroF_Controller::class, 'updateMatricula']);
Route::delete('/formandos/{id}', [CentroF_Controller::class, 'destroyMatricula'])->name('formandos.destroy');
Route::post('/formandos/{id}/delete', [CentroF_Controller::class, 'destroyMatricula']);
Route::get('/matriculas', [CentroF_Controller::class, 'matriculas'])->name('matriculas.index');
Route::post('/matriculas', [CentroF_Controller::class, 'storeMatricula'])->name('matriculas.store');
Route::put('/matriculas/{id}', [CentroF_Controller::class, 'updateMatricula'])->name('matriculas.update');
Route::post('/matriculas/{id}', [CentroF_Controller::class, 'updateMatricula']);
Route::delete('/matriculas/{id}', [CentroF_Controller::class, 'destroyMatricula'])->name('matriculas.destroy');
Route::post('/matriculas/{id}/delete', [CentroF_Controller::class, 'destroyMatricula']);

Route::get('/certificacoes', [CentroF_Controller::class, 'certificacoes']);
Route::get('/relatorios', [CentroF_Controller::class, 'relatorios']);
Route::get('/definicoes', [CentroF_Controller::class, 'definicoes']);
Route::get('/login', [CentroF_Controller::class, 'login']);
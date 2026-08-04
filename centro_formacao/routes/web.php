<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;

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

Route::get('/', [EventController::class, 'index']);

Route::get('/matriculas', [EventController::class, 'matriculas']);

Route::post('/matriculas', [EventController::class, 'store'])->name('matriculas.store');

Route::put('/matriculas/{id}', [EventController::class, 'update'])->name('matriculas.update');

Route::delete('/matriculas/{id}', [EventController::class, 'destroy'])->name('matriculas.destroy');

Route::get('/matriculas/{id}', [EventController::class, 'show'])->name('matriculas.show');

Route::get('/matriculas/{id}', [EventController::class, 'edit'])->name('matriculas.edit');

Route::get('/relatorios', [EventController::class, 'relatorios']);

Route::get('/definicoes', [EventController::class, 'definicoes']);

Route::get('/certificacoes', [EventController::class, 'certificacoes']);

Route::get('/cursos_turmas', [EventController::class, 'cursos_turmas']);

Route::post('/cursos_turmas', [EventController::class, 'storeTurma'])->name('turmas.store');

Route::put('/turmas/{id}', [EventController::class, 'updateTurma'])->name('turmas.update');

Route::delete('/turmas/{id}', [EventController::class, 'destroyTurma'])->name('turmas.destroy');

Route::post('/cursos', [EventController::class, 'storeCurso'])->name('cursos.store');

Route::put('/cursos/{id}', [EventController::class, 'updateCurso'])->name('cursos.update');

Route::delete('/cursos/{id}', [EventController::class, 'destroyCurso'])->name('cursos.destroy');

Route::get('/formandos', [EventController::class, 'formandos']);

Route::post('/formandos', [EventController::class, 'storeFormando'])->name('formandos.store');

Route::get('/dashboard', [EventController::class, 'dashboard']);

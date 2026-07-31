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

Route::get('/relatorios', [EventController::class, 'relatorios']);

Route::get('/definicoes', [EventController::class, 'definicoes']);

Route::get('/certificacoes', [EventController::class, 'certificacoes']);

Route::get('/cursos_turmas', [EventController::class, 'cursos_turmas']);

Route::get('/formandos', [EventController::class, 'formandos']);

Route::get('/dashboard', [EventController::class, 'dashboard']);

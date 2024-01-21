<?php

use App\Mail\MensagemTesteMail;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Route::resource('tarefas', 'App\Http\Controllers\TarefaController')->middleware('auth'); //another option of auth validation
Route::resource('tarefas', 'App\Http\Controllers\TarefaController');

// Specific routing for tarefa.store as test in case of routing not founding the resources route.
Route::post('/tarefa.store', 'App\Http\Controllers\TarefaController@store')->name('tarefa.store');

Route::get('/mensagem-teste', function () {
    return new MensagemTesteMail();
    // Mail::to('tiassessoreri@gmail.com')->send(new MensagemTesteMail());
    // return 'E-mail sent!';
});
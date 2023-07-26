<?php
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ArchivioController;
use App\Http\Controllers\FlowController;
use App\Http\Controllers\UsersController;

use App\Http\Controllers\StepController;
use App\Http\Controllers\UserRequestController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
    
//     return view('dashboard.home');
// });

Route::resource('flow', FlowController::class)->middleware('auth');
Route::get('flow/{flow}/delete', [FlowController::class, 'destroy']);

Route::resource('archivio', ArchivioController::class)->middleware('auth');
Route::get('archivio/{archivio}/delete', [ArchivioController::class, 'destroy']);


Route::resource('steps', StepController::class)->middleware('auth');
Route::get('steps/{id}/delete', [StepController::class, 'destroy']);

Route::resource('/', IndexController::class)->middleware('auth');
// route::get('/docs', function (){
//     return view('docs.index');
// });

Route::resource('users', UsersController::class)->middleware('auth');
Route::get('users/{id}/delete', [UsersController::class, 'destroy']);

Route::resource('request', UserRequestController::class)->middleware('auth');
Route::get('request/{id}/delete', [UserRequestController::class, 'destroy']);

// Route::get('/dashboard', function () {
//     return view('dashboard.prova.index');
// });



?>
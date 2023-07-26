<?php


use App\Http\Controllers\IndexController;
use App\Http\Controllers\LandingPageController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


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
// Route::get('archivio/{archivio}/delete', [ArchivioController::class, 'destroy']);
// Route::resource('archivio', ArchivioController::class);
// Route::resource('flow', FlowController::class);
// Route::get('flow/{flow}/delete', [FlowController::class, 'destroy']);
// Route::resource('/steps', StepController::class);
// Route::get('steps/{id}/delete', [StepController::class, 'destroy']);
// route::get('/docs', function (){
//     return view('docs.index');
// })


// Route::get('/landing/sessione', [LandingPageController::class, 'manageStepFlowSession']);

Route::resource('landing', LandingPageController::class);
Route::get('/sessione', [LandingPageController::class, 'manageStepFlowSession'])->name('landing.manage');


Route::get('/', function () {
    if (Auth::check()) {
        return redirect('/admin');
    }else{
    
    return view('auth.login');
    }
});

Auth::routes();

Route::get('welcome', function(){
    return view('welcome');
});

Route::get('dashboard', function(){
    return view('dashboard.home');
});






Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

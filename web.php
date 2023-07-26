<?php



use App\Http\Controllers\LandingPageController;
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
    return view('home');
});

Route::get('login', function(){
    return view('admin.login');
});

Route::get('register', function(){
    return view('admin.register');
});





Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

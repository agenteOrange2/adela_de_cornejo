<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AvisoController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\CampusController;
use App\Http\Controllers\OfertaController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CafeteriaController;
use App\Http\Controllers\Admin\CalendarController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::post('images/upload', [ImageController::class, 'upload'])->name('images.upload');

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [HomeController::class, 'index'])->name('index');

Route::get('/adela-de-cornejo', function () {
    return view('pages.adela-de-cornejo');    
})->name('adela-de-cornejo');

/* Campus */
Route::get('/campus-iv-siglos', [CampusController::class, 'showIvSiglos'])->name('pages.campus.ivsiglos');
Route::get('/campus-triunfo', [CampusController::class, 'showTriunfo'])->name('pages.campus.triunfo');

/* Oferta Academica */

Route::get('/oferta-academica', function () {
    return view('pages.oferta-academica');    
})->name('oferta-academica');

// Route::middleware(['check.plantel.auth'])->group(function () {
Route::get('/avisos', [AvisoController::class,'index'])->name('avisos');
Route::get('/avisos/{aviso}', [AvisoController::class, 'show'])->name('avisos.show');
//});

Route::get('/eventos', [EventController::class, 'index'])->name('eventos');
Route::get('/eventos/{evento}', [EventController::class, 'show'])->name('eventos.show');
Route::get('/eventos/category/{id}', [EventController::class, 'category'])->name('eventos.category');
Route::get('/eventos/plantel/{id}', [EventController::class, 'plantel'])->name('eventos.plantel');



Route::get('/admision-preescolar', [OfertaController::class, 'showAdmissionPreescolar'])->name('admision.preescolar');
Route::get('/admision-primaria', [OfertaController::class, 'showAdmissionPrimaria'])->name('admision.primaria');
Route::get('/admision-secundaria', [OfertaController::class, 'showAdmissionSecundaria'])->name('admision.secundaria');
Route::get('/get-pdfs-by-plantel-and-level', [OfertaController::class, 'getPdfsByPlantelAndLevel'])->name('get-pdfs-by-plantel-and-level');


Route::get('/admisiones', function () {
    return view('pages.admisiones');    
})->name('admisiones');

Route::get('admin/campus-triunfo', function () {
    return view('admin.campusFiles.triunfo');    
})->name('triunfo');


/************CLUBES************/
Route::get('/clubes', function () {
    return view('pages.clubes');    
})->name('clubes');

Route::get('/clubes/{club}', function ($club) {
    if (view()->exists('pages.clubes.' . $club)) {
        return view('pages.clubes.' . $club);
    }
    abort(404, 'Club no encontrado');
})->name('clubes.show');

Route::get('/estancia', function () {
    return view('pages.estancia');    
})->name('estancia');

Route::get('/cafeteria', [CafeteriaController::class, 'index'])->name('cafeteria');


Route::get('/regularizacion', function () {
    return view('pages.regularizacion');    
})->name('regularizacion');



Route::get('contacto', [ContactController::class, 'index'])->name('contacto.index');
Route::post('contacto', [ContactController::class, 'store'])->name('contacto.store');



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});
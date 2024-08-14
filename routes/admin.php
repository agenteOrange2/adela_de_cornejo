<?php

use Illuminate\Support\Facades\Route;
use Spatie\Permission\Contracts\Permission;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\PlantelController;
use App\Http\Controllers\Admin\CalendarController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\SchoolCycleController;
use App\Http\Controllers\Admin\PostCategoryController;
use App\Http\Controllers\Admin\CafeteriaMenuController;
use App\Http\Controllers\Admin\EventCategoryController;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [DashboardController::class, 'index'])
->middleware('can:Dashboard')
->name('dashboard');

// Asumiendo que usas un grupo con prefijo 'admin' y middleware de autenticación

/* ****************************** */
/* **** PLANTELES***** */
/* ****************************** */
// Muestra la página de detalles del plantel
Route::get('planteles/{plantel}', [PlantelController::class, 'show'])->middleware('can:Planteles')->name('planteles.show');

// Muestra el formulario de edición
Route::get('planteles/{plantel}/edit', [PlantelController::class, 'edit'])->middleware('can:Planteles')->name('planteles.edit');

// Procesa la actualización del plantel
Route::put('planteles/{plantel}', [PlantelController::class, 'update'])->middleware('can:Planteles')->name('planteles.update');

/* ****************************** */
/* **** CALENDARIO ***** */
/* ****************************** */
Route::resource('ciclo-escolar', SchoolCycleController::class)->middleware('can:Oferta Académica');

Route::resource('calendarios', CalendarController::class)->middleware('can:Oferta Académica');

/* ****************************** */
/* **** CRUD SERVICIOS ***** */
/* ****************************** */
Route::resource('menu-cafeteria', CafeteriaMenuController::class)->except('create','edit')->middleware('can:Servicios')->parameters(['menu-cafeteria' => 'menu_cafeteria']);
/* ****************************** */
/* ** CRUD CATEGORÍAS EVENTOS  **/
/* ****************************** */
Route::resource('categories-eventos', EventCategoryController::class)->middleware('can:Eventos y Avisos');

/* ****************************** */
/* ****     CRUD EVENTOS   ***** */
/* ****************************** */
Route::resource('eventos', EventController::class)->middleware('can:Eventos y Avisos');
Route::delete('eventos/{evento}/gallery/{image}', function ($eventoId, $imageId) {
    $evento = App\Models\Event::findOrFail($eventoId);
    $image = App\Models\Image::findOrFail($imageId);

    return app(App\Http\Controllers\Admin\EventController::class)->destroyImage($evento, $image);
})->name('admin.eventos.destroyImage');
//Route::delete('eventos/{evento}/gallery/{image}', [EventController::class, 'destroyImage'])->name('admin.eventos.destroyImage');

/* ****************************** */
/* **** CRUD AVISOS***** */
/* ****************************** */
Route::resource('categories-avisos', PostCategoryController::class)->middleware('can:Eventos y Avisos');
Route::resource('avisos', PostController::class);

Route::delete('/avisos/pdf/{pdf}', [PostController::class, 'destroyPdf'])->middleware('can:Eventos y Avisos')->name('avisos.destroy.pdf');


/* ****************************** */
/* **** SLIDERS ***** */
/* ****************************** */
Route::resource('sliders', SliderController::class)->middleware('can:Sliders');
Route::delete('/admin/sliders/{id}', [SliderController::class, 'destroy'])->middleware('can:Sliders')->name('admin.sliders.destroy');

/* ****************************** */
/* **** CRUD ROLES ***** */
/* ****************************** */
Route::resource('roles', RoleController::class);

Route::resource('permissions', PermissionController::class)->middleware('can:Permisos');

Route::resource('users', UserController::class);


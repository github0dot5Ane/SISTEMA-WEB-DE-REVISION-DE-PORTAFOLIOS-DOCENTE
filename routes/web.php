<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RevisorController;
use App\Http\Controllers\DocenteController;
use App\Http\Controllers\CargaAcademicaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PortafolioController;
use App\Http\Controllers\RevisionController;
use App\Http\Controllers\BackupController;

use Illuminate\Support\Facades\Route;

// Ruta de bienvenida
Route::get('/', function () {
    return view('welcome');
});

// Ruta genérica para el dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// Rutas para el administrador
Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

// Rutas para el revisor
Route::get('/revisor/dashboard', [RevisorController::class, 'index'])->name('revisor.dashboard');

// Rutas para el docente
Route::get('/docente/dashboard', [DocenteController::class, 'index'])->name('docente.dashboard');

// Rutas para los usuarios bajo el prefijo "admin"
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/usuarios', [UserController::class, 'index'])->name('usuarios.index');
    Route::get('/usuarios/create', [UserController::class, 'create'])->name('usuarios.create');
    Route::post('/usuarios', [UserController::class, 'store'])->name('usuarios.store');
    Route::delete('/usuarios/{id}', [UserController::class, 'destroy'])->name('usuarios.destroy');
    Route::get('/usuarios/{user}', [UserController::class, 'show'])->name('usuarios.show');
    Route::get('/usuarios/{user}/edit', [UserController::class, 'edit'])->name('usuarios.edit');
    Route::put('/usuarios/{user}', [UserController::class, 'update']);
    Route::get('/revisiones', [RevisionController::class, 'index'])->name('revisiones.index');
    Route::post('/revisar/{id}', [RevisionController::class, 'asignarRevisor'])->name('revisiones.asignar');
    Route::get('/registro-actividades', [RevisionController::class, 'registroActividades'])->name('registro.actividades');
    Route::post('/generar-copia', [BackupController::class, 'generarCopia'])->name('generar-copia');
    Route::get('/generar-copia', [BackupController::class, 'form'])->name('generar-copia.form');
    Route::get('/carga-academica/form', [CargaAcademicaController::class, 'form'])->name('carga-academica.form');
    Route::post('/carga-academica/upload', [CargaAcademicaController::class, 'upload'])->name('carga-academica.upload');
    Route::get('/generar-informes', [RevisionController::class, 'generarInformes'])->name('generar_reportes');
    Route::get('/generar-informes-pdf', [RevisionController::class, 'generarInformesExcel'])->name('generar-informes-pdf');

});


Route::prefix('revisor')->name('revisor.')->group(function () {
    Route::get('/pendientes-revision', [RevisionController::class, 'pendientesRevision'])->name('pendientes_revision');
    Route::get('/editar/detalles-generales/{id}', [PortafolioController::class, 'editarDetallesGenerales'])->name('editar.detallesGenerales');
    Route::get('/editar/items-teorico/{id}', [PortafolioController::class, 'editarItemsTeorico'])->name('editar.itemsTeorico');
    Route::get('/editar/items-practico/{id}', [PortafolioController::class, 'editarItemsPractico'])->name('editar.itemsPractico');
    Route::post('/guardar/detalles-generales/{id}', [PortafolioController::class, 'guardarDetallesGenerales'])->name('guardar.detallesGenerales');
    Route::post('/guardar/items-teorico/{id}', [PortafolioController::class, 'guardarItemsTeorico'])->name('guardar.itemsTeorico');
    Route::post('/guardar/items-practico/{id}', [PortafolioController::class, 'guardarItemsPractico'])->name('guardar.itemsPractico');
    Route::get('/ingresar-observacion', [RevisorController::class, 'mostrarRevisiones'])->name('ingresar_observacion');
    Route::post('/guardar-observacion/{id_revision}', [RevisorController::class, 'guardarObservacion'])->name('guardar_observacion');
    


});
Route::put('/admin/usuarios/{id}', [UserController::class, 'update']);
Route::patch('/admin/usuarios/{id}/update-status', [UserController::class, 'updateStatus']);
Route::resource('admin/usuarios', UserController::class);


Route::prefix('docente')->name('docente.')->group(function () {
    Route::get('/visualizar-estado', [DocenteController::class, 'visualizarEstado'])->name('visualizar_estado');
    Route::post('/cambiar-estado/{id}', [DocenteController::class, 'cambiarEstado'])->name('cambiar_estado');
});





// routes/web.php


Route::post('/crear-portafolios', [PortafolioController::class, 'crearPortafolios']);
Route::get('/admin/crear-portafolios/form', [PortafolioController::class, 'mostrarFormulario'])->name('admin.crear-portafolios');
Route::post('/admin/crear-portafolios', [PortafolioController::class, 'crearPortafolios'])->name('admin.crear-portafolios.create');




Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

// Requiere el archivo de autenticación
require __DIR__.'/auth.php';

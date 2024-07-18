<?php

use App\Http\Controllers\CitaController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\ServicioController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ProductoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MedicamentoController;
use App\Http\Controllers\ConsultaController;

Route::get('/doctor/consultas', [ConsultaController::class, 'index'])->name('doctor.consultas');

// Servicios:
Route::middleware(['auth'])->group(function () {
    Route::get('/servicios/create', [ServicioController::class, 'create'])->name('servicios.create');
    Route::post('/servicios/store', [ServicioController::class, 'store'])->name('servicios.store');
    Route::delete('/servicios/{id}', [ServicioController::class, 'destroy'])->name('servicios.destroy');
    Route::patch('/servicios/{id}', [ServicioController::class, 'update'])->name('servicios.update');
});
//Citas:
Route::get('/agendas/create', [AgendaController::class, 'create'])->name('agendas.create');
Route::post('/agendas/store', [AgendaController::class, 'store'])->name('agendas.store');
Route::post('/agendas/{id}/atendida', [AgendaController::class, 'atendida'])->name('agendas.atendida');
Route::post('/agendas/{id}/desatendida', [AgendaController::class, 'desatendida'])->name('agendas.desatendida');
// Agenda:
Route::get('/secretaria/calendario', [AgendaController::class, 'create'])->name('secretaria.calendario');
Route::get('/doctor/calendario', [AgendaController::class, 'create'])->name('doctor.calendario');
//Users:
Route::middleware(['auth'])->group(function () {
    Route::get('/users/create', [UsersController::class, 'create'])->name('users.create');
    Route::post('/users', [UsersController::class, 'store'])->name('users.store');
    Route::delete('/users/{id}', [UsersController::class, 'destroy'])->name('users.destroy');
});
Route::get('/', function () {return view('welcome');});
Route::get('/dashboard', [MenuController::class, 'calendario'])->middleware(['auth', 'verified'])->name('calendario');
Route::get('/pacientes', [MenuController::class, 'pacientes'])->middleware(['auth', 'verified'])->name('pacientes');
Route::get('/productos', [MenuController::class, 'productos'])->middleware(['auth', 'verified'])->name('productos');
Route::get('/usuarios', [MenuController::class, 'usuarios'])->middleware(['auth', 'verified'])->name('usuarios');
Route::get('/calendario', [MenuController::class, 'calendario'])->middleware(['auth', 'verified'])->name('calendario');
Route::get('/consultas', [MenuController::class, 'consultas'])->middleware(['auth', 'verified'])->name('consultas');
Route::get('/servicios', [MenuController::class, 'servicios'])->middleware(['auth', 'verified'])->name('servicios');
Route::get('/medicamentos', [MenuController::class, 'medicamentos'])->middleware(['auth', 'verified'])->name('medicamentos');
//Productos:
Route::get('/productos/create', [ProductoController::class, 'create'])->name('productos.create');
Route::post('/productos/store', [ProductoController::class, 'store'])->name('productos.store');
Route::delete('/productos/{id}', [ProductoController::class, 'destroy'])->name('productos.destroy');
Route::patch('/productos/{id}', [ProductoController::class, 'update'])->name('productos.update');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//Pacientes
Route::get('/patients/create', [PatientController::class, 'create'])->name('patients.create');
Route::post('/patients/store', [PatientController::class, 'store'])->name('patients.store');
Route::delete('/patients/{id}', [PatientController::class, 'destroy'])->name('patients.destroy');
Route::patch('/patients/{id}', [PatientController::class, 'update'])->name('patients.update');

Route::get('/dashboard', [MenuController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/consultas/{id}', [ConsultaController::class, 'show'])->name('consultas.show');


//Medicamentos:
Route::get('/medicamentos/create', [MedicamentoController::class, 'create'])->name('medicamentos.create');
Route::post('/medicamentos/store', [MedicamentoController::class, 'store'])->name('medicamentos.store');
Route::delete('/medicamentos/{id}', [MedicamentoController::class, 'destroy'])->name('medicamentos.destroy');
Route::patch('/medicamentos/{id}', [MedicamentoController::class, 'update'])->name('medicamentos.update');


require __DIR__.'/auth.php';

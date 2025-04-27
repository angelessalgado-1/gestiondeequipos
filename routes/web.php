<?php
use App\Http\Controllers\EquipoController;
use App\Http\Controllers\JugadorController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [EquipoController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
    Route::get('/equipos/create', [EquipoController::class, 'create'])->name('equipos.create');
    Route::post('/equipos', [EquipoController::class, 'store'])->name('equipos.store');
    Route::get('/equipos/{equipo}/edit', [EquipoController::class, 'edit'])->name('equipos.edit');
    Route::put('/equipos/{equipo}', [EquipoController::class, 'update'])->name('equipos.update');
    Route::delete('/equipos/{equipo}', [EquipoController::class, 'destroy'])->name('equipos.destroy');
    Route::get('/equipos/{equipo}/jugadores', [JugadorController::class, 'index'])->name('equipos.jugadores'); // Mostrar jugadores del equipo
    Route::get('/equipos/{equipo}/jugadores/create', [JugadorController::class, 'create'])->name('jugadores.create'); // Mostrar formulario para crear un jugador
    Route::post('/equipos/{equipo}/jugadores', [JugadorController::class, 'store'])->name('jugadores.store'); // Almacenar un nuevo jugador
    Route::get('/jugadores/{jugador}/edit', [JugadorController::class, 'edit'])->name('jugadores.edit'); // Mostrar formulario de edición de un jugador
    Route::put('/jugadores/{jugador}', [JugadorController::class, 'update'])->name('jugadores.update'); // Actualizar un jugador
    Route::delete('/jugadores/{jugador}', [JugadorController::class, 'destroy'])->name('jugadores.destroy'); // Eliminar un jugador
});

require __DIR__.'/auth.php';

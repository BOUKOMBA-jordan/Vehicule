<?php

use \App\Http\Controllers\HomeController;
use \App\Http\Controllers\VehicleController;
use App\Http\Controllers\VehicleImageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Redirection du tableau de bord
Route::get('/dashboard', function () {
    return redirect()->intended(route('admin.vehicle.index'));
})->middleware(['auth', 'verified'])->name('dashboard');

// Routes pour la gestion du profil utilisateur
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Définition des expressions régulières pour l'ID et le slug
$idRegex = '[0-9]+';
$slugRegex = '[a-zA-Z0-9\-]+';

// Routes publiques pour les véhicules
Route::get('/', [HomeController::class, 'index']);
Route::get('/vehicles', [VehicleController::class, 'index'])->name('vehicle.index');
Route::get('/vehicles/{make}/{model}/{id}', [VehicleController::class, 'show'])
    ->name('vehicle.show')
    ->where(['id' => '[0-9]+', 'make' => '[a-zA-Z0-9\-]+', 'model' => '[a-zA-Z0-9\-]+']);
Route::post('/vehicles/{vehicle}/contact', [VehicleController::class, 'contact'])
    ->name('vehicle.contact')
    ->where('vehicle', '[0-9]+');


// Préfixe pour les routes de l'administration
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::resource('vehicle', \App\Http\Controllers\Admin\VehicleController::class)->except(['show']);
    Route::resource('option', \App\Http\Controllers\Admin\OptionController::class)->except(['show']);

    // Routes pour la gestion des images des véhicules
    Route::get('vehicle/{vehicleId}/upload', [VehicleImageController::class, 'index'])->name('vehicle.upload');
    Route::post('vehicle/{vehicleId}/upload', [VehicleImageController::class, 'store'])->name('vehicle.upload.store');
    Route::delete('vehicle/image/{vehicleImageId}', [VehicleImageController::class, 'destroy'])->name('vehicle.image.destroy');
});

require __DIR__.'/auth.php';
<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Warehouse;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Warehouse routes
    Route::get('/warehouse', [Warehouse::class, 'index'])->name('warehouse.index');
    Route::get('/alergeen/{id}', [Warehouse::class, 'alergeen'])->name('warehouse.alergeen');
    Route::get('/leverancier/{id}', [Warehouse::class, 'leverancier'])->name('warehouse.leverancier');

    // User Story 1: Leveranciers overzicht
    Route::get('/leveranciers', [Warehouse::class, 'leveranciers'])->name('warehouse.leveranciers');
    Route::get('/leveranciers/{leverancierId}/producten', [Warehouse::class, 'geleverdeProducten'])->name('warehouse.geleverde-producten');

    // User Story 2: Product levering toevoegen
    Route::get('/leveranciers/{leverancierId}/producten/{productId}/nieuwe-levering', [Warehouse::class, 'nieuweLevering'])->name('warehouse.nieuwe-levering');
    Route::post('/leveranciers/store-levering', [Warehouse::class, 'storeLevering'])->name('warehouse.store-levering');
});

require __DIR__.'/auth.php';

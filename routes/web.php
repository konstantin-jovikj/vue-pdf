<?php

use App\Http\Controllers\DocumentController;
use App\Models\DocType;
use App\Models\Fuel;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('dashboard', function () {
    $docTypes = DocType::all();
    $fuels = Fuel::all();
    return Inertia::render('Dashboard', [
        'docTypes' => $docTypes,
        'fuels' => $fuels,
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::post('document/store', [DocumentController::class, 'store'])->middleware(['auth', 'verified'])->name('document.store');

Route::get('/documents', [DocumentController::class, 'index'])->middleware(['auth', 'verified'])->name('documents.index');
Route::get('/document/{document}/show', [DocumentController::class, 'show'])->middleware(['auth', 'verified'])->name('document.show');
Route::get('/document/{document}/edit', [DocumentController::class, 'edit'])->middleware(['auth', 'verified'])->name('document.edit');
Route::put('/document/update/{document}', [DocumentController::class, 'update'])->middleware(['auth', 'verified'])->name('document.update');


require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';

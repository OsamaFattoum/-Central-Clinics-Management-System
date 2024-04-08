<?php

use App\Http\Controllers\ClinicAccreditationsController;
use App\Http\Controllers\ClinicController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\PharmacyController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
})->name('welcome');



Route::middleware('auth:admin,clinic,pharmacy')->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::name('admin.')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    Route::resource('departments', DepartmentController::class)->except(['create', 'show', 'edit']);
    Route::delete('departments', [DepartmentController::class, 'bulk'])->name('departments.bulk');

    Route::resource('clinics', ClinicController::class);
    Route::get('clinics/{clinic}/status', [ClinicController::class, 'status'])->name('clinics.status');
    Route::delete('clinics', [ClinicController::class, 'bulk'])->name('clinics.bulk');

    Route::prefix('clinics/{clinic}')->group(function () {
        Route::resource('accreditations', ClinicAccreditationsController::class)->except(['create', 'show', 'edit']);
        Route::delete('accreditations', [ClinicAccreditationsController::class, 'bulk'])->name('accreditations.bulk');
    });

    Route::resource('pharmacies', PharmacyController::class);
    Route::get('pharmacies/{pharmacy}/status', [PharmacyController::class, 'status'])->name('pharmacies.status');
    Route::delete('pharmacies', [PharmacyController::class, 'bulk'])->name('pharmacies.bulk');
});

require __DIR__ . '/auth.php';

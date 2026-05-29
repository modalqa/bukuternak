<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CycleController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\FeedLogController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\MortalityLogController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\SaleController;
use Illuminate\Support\Facades\Route;

// Landing
use App\Http\Controllers\LandingController;
Route::get('/', [LandingController::class, 'index']);

// Auth
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Authenticated app
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan');
    Route::get('/profil', [ProfilController::class, 'index'])->name('profil');

    // Cycles
    Route::get('/cycles', [CycleController::class, 'index'])->name('cycles.index');
    Route::get('/cycles/new', [CycleController::class, 'create'])->name('cycles.create');
    Route::post('/cycles', [CycleController::class, 'store'])->name('cycles.store');
    Route::get('/cycles/{cycle}', [CycleController::class, 'show'])->name('cycles.show');
    Route::get('/cycles/{cycle}/edit', [CycleController::class, 'edit'])->name('cycles.edit');
    Route::put('/cycles/{cycle}', [CycleController::class, 'update'])->name('cycles.update');
    Route::post('/cycles/{cycle}/complete', [CycleController::class, 'complete'])->name('cycles.complete');

    // Feed logs
    Route::get('/cycles/{cycle}/feed', [FeedLogController::class, 'create'])->name('cycles.feed.create');
    Route::post('/cycles/{cycle}/feed', [FeedLogController::class, 'store'])->name('cycles.feed.store');
    Route::delete('/cycles/{cycle}/feed/{feedLog}', [FeedLogController::class, 'destroy'])->name('cycles.feed.destroy');

    // Mortality logs
    Route::get('/cycles/{cycle}/mortality', [MortalityLogController::class, 'create'])->name('cycles.mortality.create');
    Route::post('/cycles/{cycle}/mortality', [MortalityLogController::class, 'store'])->name('cycles.mortality.store');
    Route::delete('/cycles/{cycle}/mortality/{mortalityLog}', [MortalityLogController::class, 'destroy'])->name('cycles.mortality.destroy');

    // Expenses
    Route::get('/cycles/{cycle}/expenses', [ExpenseController::class, 'create'])->name('cycles.expenses.create');
    Route::post('/cycles/{cycle}/expenses', [ExpenseController::class, 'store'])->name('cycles.expenses.store');
    Route::delete('/cycles/{cycle}/expenses/{expense}', [ExpenseController::class, 'destroy'])->name('cycles.expenses.destroy');

    // Sales
    Route::get('/cycles/{cycle}/sales', [SaleController::class, 'create'])->name('cycles.sales.create');
    Route::post('/cycles/{cycle}/sales', [SaleController::class, 'store'])->name('cycles.sales.store');
    Route::delete('/cycles/{cycle}/sales/{sale}', [SaleController::class, 'destroy'])->name('cycles.sales.destroy');
});

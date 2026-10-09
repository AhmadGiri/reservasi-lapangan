<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CourtController;
use App\Http\Controllers\BookingController;

// Halaman Publik / Pelanggan
Route::get('/', [BookingController::class, 'index'])->name('customer.index');
Route::post('/checkout', [BookingController::class, 'store'])->name('customer.checkout');

// Admin Dashboard & Protected Routes
Route::get('/dashboard', [BookingController::class, 'adminDashboard'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Admin Routes untuk Lapangan & Reservasi
    Route::get('/admin/dashboard', [BookingController::class, 'adminDashboard'])->name('admin.dashboard');
    Route::patch('/admin/bookings/{id}/status', [BookingController::class, 'updateStatus'])->name('admin.bookings.updateStatus');
    Route::resource('/admin/courts', CourtController::class);
});

require __DIR__.'/auth.php';
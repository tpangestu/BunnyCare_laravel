<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontendController; // Import Controller ini
use App\Http\Controllers\BookingController; // Import Controller ini

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

// --- Frontend Routes ---
Route::get('/', [FrontendController::class, 'home'])->name('home');
Route::get('/gallery', [FrontendController::class, 'gallery'])->name('gallery');
Route::get('/contact', [FrontendController::class, 'contact'])->name('contact');

// Routes untuk proses pemesanan dari form
Route::post('/booking/grooming', [BookingController::class, 'storeGroomingBooking'])->name('booking.grooming');
Route::post('/booking/clinic', [BookingController::class, 'storeClinicBooking'])->name('booking.clinic');
Route::post('/booking/hotel', [BookingController::class, 'storeHotelBooking'])->name('booking.hotel');

Route::get('/booking/success/{type}/{id}', [BookingController::class, 'showBookingSuccess'])->name('booking.success');


// --- Backend/Admin Routes (Sudah ada dari sebelumnya) ---
Route::prefix('admin')->middleware(['auth'])->group(function () {
    // Dashboard admin
    Route::get('/dashboard', function () {
        return view('backend.dashboard');
    })->name('admin.dashboard');

    // Ini adalah rute yang dibuat oleh Filament, jadi biasanya tidak perlu kita definisikan ulang di sini
    // Filament akan otomatis membuat rute untuk semua resource yang sudah kita buat.
    // Contoh: /admin/services, /admin/grooming-bookings, dll.
    // Kita biarkan Filament yang mengurus rute admin.
});

// Rute autentikasi Breeze (login, register, dll)
require __DIR__.'/auth.php'; // Ini dari Laravel Breeze
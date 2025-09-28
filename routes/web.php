<?php


use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Guru\GuruDashboardController;
use App\Http\Controllers\Siswa\SiswaDashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\UserManagementController;
use App\Http\Controllers\BankSoalController;

// Halaman login

Route::get('/', function () {
    return redirect()->route('login');
});


// Dashboard Admin
Route::get('/dashboard', [AdminDashboardController::class, 'index'])
    ->middleware(['auth', 'role:admin', 'verified'])
    ->name('dashboard');
Route::get('/admin/profile', [ProfileController::class, 'edit'])->name('admin.profile.edit');
Route::patch('/admin/profile', [ProfileController::class, 'update'])->name('admin.profile.update');
Route::delete('/admin/profile', [ProfileController::class, 'destroy'])->name('admin.profile.destroy');
Route::get('/users', [UserManagementController::class, 'index'])->name('users');
    Route::post('/users', [UserManagementController::class, 'store'])->name('users.store');
    Route::get('/users/{user}/edit', [UserManagementController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserManagementController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserManagementController::class, 'destroy'])->name('users.destroy');
Route::get('/users/download-template', [UserManagementController::class, 'downloadTemplate'])->name('users.downloadTemplate');
Route::post('/users/import', [UserManagementController::class, 'import'])->name('users.import');
 // Guru → hanya Data Guru
    Route::get('/guru/data-guru', [GuruController::class, 'index'])->name('guru.data_guru');

    // Siswa → hanya Data Siswa
    Route::get('/siswa/data-siswa', [SiswaController::class, 'index'])->name('siswa.data_siswa');







Route::middleware(['auth', 'role:admin,guru'])->group(function () {
    Route::get('/banksoal', [BankSoalController::class, 'index'])->name('banksoal.index');
    Route::post('/banksoal', [BankSoalController::class, 'store'])->name('banksoal.store');
    
});


require __DIR__.'/auth.php';
// Dashboard Guru
// Route::middleware(['auth', 'role:guru'])->group(function () {
//     Route::get('/guru/dashboard', [GuruDashboardController::class, 'index'])
//         ->name('guru.dashboard');
// });

// Dashboard Siswa
// Route::middleware(['auth', 'role:siswa'])->group(function () {
//     Route::get('/siswa/dashboard', [SiswaDashboardController::class, 'index'])
//         ->name('siswa.dashboard');
// });

// Profile (semua role bisa akses setelah login)
// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });



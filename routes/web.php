<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GejalaController;
use App\Http\Controllers\PenyakitController;
use App\Http\Controllers\RuleController;
use App\Http\Controllers\DiagnosisController;

// Route untuk halaman utama
Route::get('/', function () {
    return redirect()->route('diagnosis.index');
});

// Route untuk autentikasi
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Route untuk registrasi (opsional)
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

// Route untuk diagnosis (publik)
Route::get('/diagnosis', [DiagnosisController::class, 'index'])->name('diagnosis.index');
Route::post('/diagnosis/proses', [DiagnosisController::class, 'proses'])->name('diagnosis.proses');
Route::get('/informasi-sistem', [DiagnosisController::class, 'informasiSistem'])->name('informasi.sistem');

// Route untuk admin (perlu autentikasi)
Route::middleware(['admin'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Manajemen Gejala
    Route::resource('gejala', GejalaController::class);
    
    // Manajemen Penyakit
    Route::resource('penyakit', PenyakitController::class);
    
    // Manajemen Rule
    Route::resource('rule', RuleController::class);
    
    // Riwayat Diagnosis
    Route::get('/riwayat', [DiagnosisController::class, 'riwayat'])->name('diagnosis.riwayat');
    Route::get('/riwayat/{id}', [DiagnosisController::class, 'detailRiwayat'])->name('diagnosis.detail');
});

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\AdminPanelController;
use App\Http\Controllers\ContentManagementController;

/**
 * Routes untuk NexaBlog
 * 
 * @author Rafi Fathan Gandari
 * @nim C2383207002
 * @class PTI 5A
 */

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES (Frontend)
|--------------------------------------------------------------------------
| Routes yang dapat diakses oleh semua pengunjung
*/

// Homepage - Daftar artikel
Route::get('/', [FrontendController::class, 'home'])->name('home');

// Detail artikel berdasarkan slug
Route::get('/article/{slug}', [FrontendController::class, 'show'])->name('article.show');

/*
|--------------------------------------------------------------------------
| ADMIN AUTHENTICATION ROUTES
|--------------------------------------------------------------------------
| Routes untuk login/logout admin
*/

// Halaman login admin
Route::get('/admin/login', [AdminPanelController::class, 'showLogin'])
    ->name('admin.login');

// Proses login admin
Route::post('/admin/login', [AdminPanelController::class, 'login'])
    ->name('admin.login.submit');

// Logout admin
Route::post('/admin/logout', [AdminPanelController::class, 'logout'])
    ->name('admin.logout');

/*
|--------------------------------------------------------------------------
| ADMIN PROTECTED ROUTES
|--------------------------------------------------------------------------
| Routes yang hanya dapat diakses oleh admin yang sudah login
| Menggunakan custom middleware AdminAccessMiddleware
*/

Route::middleware(['admin.access'])->prefix('admin')->name('admin.')->group(function () {
    
    // Dashboard admin
    Route::get('/panel', [AdminPanelController::class, 'panel'])
        ->name('panel');
    
    // Content Management Routes
    Route::prefix('content')->name('content.')->group(function () {
        
        // List semua artikel
        Route::get('/', [ContentManagementController::class, 'index'])
            ->name('index');
        
        // Form create artikel
        Route::get('/create', [ContentManagementController::class, 'create'])
            ->name('create');
        
        // Store artikel baru
        Route::post('/', [ContentManagementController::class, 'store'])
            ->name('store');
        
        // Form edit artikel
        Route::get('/{id}/edit', [ContentManagementController::class, 'edit'])
            ->name('edit');
        
        // Update artikel
        Route::put('/{id}', [ContentManagementController::class, 'update'])
            ->name('update');
        
        // Delete artikel
        Route::delete('/{id}', [ContentManagementController::class, 'destroy'])
            ->name('destroy');
        
        // Preview artikel
        Route::get('/{id}/preview', [ContentManagementController::class, 'preview'])
            ->name('preview');
    });
});

/*
|--------------------------------------------------------------------------
| FALLBACK ROUTE
|--------------------------------------------------------------------------
| Redirect ke home jika route tidak ditemukan
*/

Route::fallback(function () {
    return redirect()->route('home')->with('error', 'Halaman tidak ditemukan');
});
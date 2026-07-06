<?php

use Illuminate\Support\Facades\Route;

// User
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\admin\ComplaintController;

// Admin
use App\Http\Controllers\Admin\ComplaintController as AdminComplaintController;
use App\Http\Controllers\Admin\ComplaintResponseController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ReportController;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::middleware(['auth'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Dashboard User/Admin
    |--------------------------------------------------------------------------
    */

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | Pengaduan Masyarakat
    |--------------------------------------------------------------------------
    */

    Route::resource('complaints', ComplaintController::class);

    /*
    |--------------------------------------------------------------------------
    | ADMIN
    |--------------------------------------------------------------------------
    */

    Route::prefix('admin')->group(function () {

        // Pengaduan
        Route::get('/complaints', [AdminComplaintController::class, 'index'])
            ->name('admin.complaints.index');

        Route::get('/complaints/{complaint}', [AdminComplaintController::class, 'show'])
            ->name('admin.complaints.show');

        Route::post('/complaints/{complaint}/response',
            [ComplaintResponseController::class, 'store'])
            ->name('admin.complaints.response');

        // Respon
        Route::get('/responses',
            [ComplaintResponseController::class, 'index'])
            ->name('admin.responses.index');

        // User
        Route::resource('users', UserController::class);

        // Laporan
        Route::get('/reports',
            [ReportController::class, 'index'])
            ->name('admin.reports.index');

    });

});

require __DIR__.'/auth.php';
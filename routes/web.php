<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ComplaintController as AdminComplaintController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\DashboardController;

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // Citizen
    Route::resource('complaints', ComplaintController::class);

    // Admin
    Route::prefix('admin')
        ->name('admin.')
        ->group(function () {

            Route::resource(
                'complaints',
                AdminComplaintController::class
            )->only([
                'index',
                'show',
                'edit',
                'update'
            ]);

        });

});
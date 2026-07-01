<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\Admin\ComplaintResponseController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::prefix('admin')->middleware(['auth'])->group(function () {

    Route::get('/complaints',[ComplaintController::class,'index'])
        ->name('admin.complaints.index');

    Route::get('/complaints/{id}',[ComplaintController::class,'show'])
        ->name('admin.complaints.show');

    Route::post('/complaints/{id}/response',[ComplaintController::class,'response'])
        ->name('admin.complaints.response');

    Route::post(
    '/complaints/{complaint}/response',
    [ComplaintResponseController::class, 'store']
)->name('admin.complaints.response');

});

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::resource('complaints', ComplaintController::class);
});

require __DIR__.'/auth.php';
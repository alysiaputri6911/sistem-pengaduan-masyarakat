<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ComplaintController;

Route::get('/dashboard', function () {
    return view('dashboard', [
        'total' => 0,
        'open' => 0,
        'progress' => 0,
        'resolved' => 0,
    ]);
})->middleware(['auth'])->name('dashboard');

Route::get('/dashboard', function () {

    return view('dashboard', [
        'total' => 0,
        'open' => 0,
        'progress' => 0,
        'resolved' => 0,
    ]);

})->middleware(['auth'])->name('dashboard');

Route::middleware(['auth'])->group(function () {

    Route::resource('complaints', ComplaintController::class);

});

require __DIR__.'/auth.php';
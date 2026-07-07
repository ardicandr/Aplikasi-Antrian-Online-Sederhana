<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QueueController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth',)->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/', function () { return view('welcome'); });
Route::get('/api/queue-status', [QueueController::class, 'getQueueStatus']);

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [QueueController::class, 'index'])->name('dashboard');
    Route::post('/queue/store', [QueueController::class, 'store'])->name('queue.store');
    Route::post('/queue/next', [QueueController::class, 'next'])->name('queue.next');
    Route::post('/queue/prev', [QueueController::class, 'prev'])->name('queue.prev'); // Tambahan Prev
});



require __DIR__.'/auth.php';

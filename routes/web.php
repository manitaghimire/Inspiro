<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SaveController;
use App\Http\Controllers\PublicUploadsController;
use Illuminate\Support\Facades\Route;



Route::get('/', [PublicUploadsController::class, 'index']);

Route::get('/welcome',[PublicUploadsController::class,'index'])->name('publicuploads.index');



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('uploads/{upload}/save',[SaveController::class,'store'])->name('upload.save');
    Route::delete('uploads{upload}/save', [SaveController::class, 'destroy'])->name('upload.unsave');
   
    Route::resource('uploads', \App\Http\Controllers\UploadsController::class)->except(['show']);
    Route::resource('uploads.reviews', \App\Http\Controllers\ReviewController::class);

    Route::middleware('is_admin')->group(function () {
        Route::resource('categories', \App\Http\Controllers\CategoryController::class);
    });

});


Route::get('uploads/{upload}', [\App\Http\Controllers\UploadsController::class, 'show'])->name('uploads.show');
// Route::resource('/categories','\App\Http\Controllers\CategoryController::class');
// ...
 

require __DIR__.'/auth.php';

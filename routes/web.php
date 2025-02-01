<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/productlisting', [ProductController::class, 'showProductListing'])->name('productlisting');
Route::get('/productform', [ProductController::class, 'showProductFrom'])->name('productform');
Route::post('/product/store', [ProductController::class, 'store'])->name('product.store');
Route::delete('/product/delete/{id}', [ProductController::class, 'delete'])->name('product.delete');
Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');


// userlisting project

Route::get('/users', [UserController::class, 'getUsers'])->name('get.users');
Route::get('/userlisting',[UserController::class,'showUserListing'])->name('userlisting');
Route::post('/add-user', [UserController::class, 'store'])->name('add.user');
Route::delete('/user/delete/{id}', [UserController::class, 'delete'])->name('user.delete');
Route::put('/user/edit/{id}', [UserController::class, 'edit'])->name('user.delete');
Route::get('/user/get/{id}', [UserController::class, 'userData']);


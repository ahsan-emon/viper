<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{FrontendController, HomeController, ProfileController, CategoryController, SubCategoryController};


Auth::routes();

Route::get('/', [FrontendController::class, 'index'])->name('frontend');
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/profile', [ProfileController::class, 'profile'])->name('profile');
Route::get('/email/offer', [HomeController::class, 'emailoffer'])->name('emailoffer');
Route::get('/category', [HomeController::class, 'category'])->name('category');
Route::get('/single/email/offer/{id}', [HomeController::class, 'singleemailoffer'])->name('singleemailoffer');
Route::post('/check/email/offer', [HomeController::class, 'checkemailoffer'])->name('checkemailoffer');
Route::post('/profile/name/change', [ProfileController::class, 'namechange'])->name('profile.namechange');
Route::post('/profile/password/change', [ProfileController::class, 'passwordchange'])->name('profile.passwordchange');
Route::post('/profile/photo/change', [ProfileController::class, 'photochange'])->name('profile.photochange');

Route::resource('category', CategoryController::class);
Route::resource('subCategory', SubCategoryController::class);

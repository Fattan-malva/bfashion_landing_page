<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingPageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [LandingPageController::class, 'index'])->name('landing.index');
Route::get('rooms', [LandingPageController::class, 'rooms'])->name('landing.rooms');
Route::get('about', [LandingPageController::class, 'about'])->name('landing.about');
Route::get('news', [LandingPageController::class, 'news'])->name('landing.news');
Route::get('contact', [LandingPageController::class, 'contact'])->name('landing.contact');
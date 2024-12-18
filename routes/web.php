<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\auth\AuthUserController;
use App\Http\Controllers\admin\DashboardController;

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
Route::get('terms-of-use', [LandingPageController::class, 'termsOfUse'])->name('landing.term-of-us');
Route::get('privacy', [LandingPageController::class, 'privacy'])->name('landing.privacy');
Route::get('enverionmental-policy', [LandingPageController::class, 'environmentalPolicy'])->name('landing.enverionmental-policy');

Route::get('/login', [AuthUserController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthUserController::class, 'login']);
Route::post('/logout', [AuthUserController::class, 'logout'])->name('logout');
Route::post('/register', [AuthUserController::class, 'storeregister'])->name('user.storeregister');
Route::get('/auth/redirect', [AuthUserController::class, 'redirect']);
Route::get('/auth/google/callback', [AuthUserController::class, 'callback']);


Route::middleware(['auth.check:admin'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.index');
});
Route::middleware(['auth.check'])->group(function () {
});
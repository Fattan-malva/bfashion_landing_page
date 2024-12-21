<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\auth\AuthUserController;
use App\Http\Controllers\admin\{UserManagementController, DashboardController};


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
    Route::get('customer', [UserManagementController::class, 'index'])->name('admin.user-management');
    Route::get('customer-create', [UserManagementController::class, 'create'])->name('admin.user-customer-create'); 
    Route::post('customer-store', [UserManagementController::class, 'store'])->name('admin.customer-store'); 
    Route::get('customer-edit/{id}', [UserManagementController::class, 'edit'])->name('<style>
    /* Custom table header and row color */
    .dataTables_wrapper .dataTables_length select,
    .dataTables_wrapper .dataTables_filter input,
    .dataTables_wrapper .dataTables_info {
        color: #5a56e0; /* Custom color for table text */
    }
    
    .dataTable th, .dataTable td {
        border-color: rgb(235, 236, 236); /* Border color */
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button {
        background-color: #5a56e0; /* Pagination button color */
        border: none;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
        background-color: #4a46c7; /* Hover effect for pagination button */
    }

    table.dataTable thead th {
        background-color: #ebecec; /* Light background for table header */
    }

    table.dataTable tbody tr:nth-child(odd) {
        background-color: #f9f9f9; /* Alternating row color */
    }

    table.dataTable tbody tr:nth-child(even) {
        background-color: #fff; /* Alternating row color */
    }

    table.dataTable tbody tr:hover {
        background-color: #e5e5e5; /* Row hover color */
    }
</style>'); 
    Route::put('customer-update/{id}', [UserManagementController::class, 'update'])->name('admin.customer-update');
    Route::delete('customer-destroy/{id}', [UserManagementController::class, 'destroy'])->name('admin.user-customer-destroy'); 
});
Route::middleware(['auth.check'])->group(function () {
});
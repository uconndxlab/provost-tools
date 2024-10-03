<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;

use App\Http\Controllers\FacultySalaryTablesController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;

Route::get('/', [HomeController::class, 'home'])->name('home');

Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');


Route::middleware(['cas.auth'])->group(function() {
    Route::get('/faculty/salary', [FacultySalaryTablesController::class, 'index'])->name('faculty_salary_tables.index');

    Route::middleware(['admin'])->group(function() {
        Route::get('/admin', [HomeController::class, 'adminHome'])->name('admin.home');
        Route::get('/admin/users', [UserController::class, 'adminIndex'])->name('admin.users.index');

        Route::get('/admin/faculty/salary', [FacultySalaryTablesController::class, 'adminIndex'])->name('admin.faculty_salary_tables.index');
    });
});


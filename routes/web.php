<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;

use App\Http\Controllers\FacultySalaryTablesController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;

Route::get('/', [HomeController::class, 'home'])->name('home');

Route::get('/login', function(Request $request) { return redirect()->route('saml.login'); })->name('login');
Route::get('/saml/login', [LoginController::class, 'samlLogin'])->name('saml.login');
Route::post('/saml', [LoginController::class, 'samlAcs'])->name('saml.acs')->withoutMiddleware([VerifyCsrfToken::class]);
Route::get('/saml/logout', [LoginController::class, 'samlLogout'])->name('saml.logout');
Route::get('/saml/processLogout', [LoginController::class, 'processSamlLogout'])->name('saml.processLogout');


Route::middleware(['saml.required'])->group(function() {
    Route::get('/faculty/salary', [FacultySalaryTablesController::class, 'index'])->name('faculty_salary_tables.index');

    Route::middleware(['admin'])->group(function() {
        Route::get('/admin', [HomeController::class, 'adminHome'])->name('admin.home');
        Route::get('/admin/users', [UserController::class, 'adminIndex'])->name('admin.users.index');
    });
});


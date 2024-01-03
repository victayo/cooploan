<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\ResetPassword;
use App\Http\Controllers\ChangePassword;
use App\Http\Controllers\GuarantorController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\Reports\FeesController;
use App\Http\Controllers\UserController;

Route::get('/', function () {return redirect('/dashboard');})->middleware('auth');
Route::get('/dashboard', [HomeController::class, 'index'])->name('home')->middleware('auth');

Route::middleware(['guest'])->group(function(){
    Route::get('/register/{user}', [RegisterController::class, 'create'])->name('register');
    Route::post('/register', [RegisterController::class, 'store'])->name('register.perform');
    Route::get('/login', [LoginController::class, 'show'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.perform');
    Route::get('/reset-password', [ResetPassword::class, 'show'])->name('reset-password');
    Route::post('/reset-password', [ResetPassword::class, 'send'])->name('reset.perform');
    Route::get('/change-password', [ChangePassword::class, 'show'])->name('change-password');
    Route::post('/change-password', [ChangePassword::class, 'update'])->name('change.perform');
});

Route::group(['middleware' => 'auth'], function () {
	Route::get('/profile', [UserProfileController::class, 'show'])->name('profile');
	Route::post('/profile', [UserProfileController::class, 'update'])->name('profile.update');
	Route::get('/profile-static', [PageController::class, 'profile'])->name('profile-static');
	Route::post('logout', [LoginController::class, 'logout'])->name('logout');

    Route::controller(UserController::class)->prefix('users')->group(function(){
        Route::get('/', 'index')->name('users.index');
        Route::get('/create', 'create')->name('users.create');
        Route::post('/', 'store')->name('users.store');
        Route::get('/{user}', 'show')->name('users.show');
        Route::get('/{user}/edit', 'edit')->name('users.edit');
        Route::post('/{user}/edit', 'update')->name('users.update');
        Route::post('/sendlink', 'sendLink')->name('users.sendlink');
        Route::delete('/{user}', 'delete')->name('users.delete');
    });

    Route::controller(LoanController::class)->prefix('loans')->group(function(){
        Route::get('/', 'index')->name('loans.index');
        Route::get('/create', 'create')->name('loans.create');
        // Route::post('/', 'store')->name('loans.store');
        Route::get('/{loan}', 'show')->name('loans.show');
        Route::get('/{loan}/edit', 'edit')->name('loans.edit');
        Route::post('{loan}/edit', 'update')->name('loans.update');
        Route::delete('/{loan}', 'delete')->name('loans.delete');
    });

    Route::controller(GuarantorController::class)->prefix('guarantor')->group(function(){
        Route::get('/', 'index')->name('guarantors.index');
        Route::post('/guarantor/{id}', 'show')->name('guarantor.show');
    });

    Route::controller(FeesController::class)->prefix('fees')->group(function(){
        Route::get('/', 'index')->name('fees.index');
    });


    Route::get('/{page}', [PageController::class, 'index'])->name('page');
});

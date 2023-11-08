<?php

use App\Http\Controllers\LoanController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::controller(LoanController::class)->prefix('loans')->group(function(){
        Route::post('/', 'store')->name('loans.store');
        Route::delete('/guarantor/{id}', 'deleteGuarantor')->name('loans.guarantor.delete');
        Route::post('/schedule', 'generatePaymentSchedule')->name('loans.schedule');
    });
});

<?php

use App\Http\Controllers\GuarantorController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\Reports\FeesController;
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
        Route::post('/schedule/{loan?}', 'generatePaymentSchedule')->name('loans.schedule');
        Route::post('/approve/{loan}', 'approveLoan')->name('loans.approve');
        Route::post('/reject/{loan}', 'rejectLoan')->name('loans.reject');
    });

    Route::controller(GuarantorController::class)->prefix('guarantor')->group(function(){
        Route::post('/approve/{id}', 'approve')->name('guarantor.approve');
        Route::post('/reject/{id}', 'reject')->name('guarantor.reject');
    });

    Route::controller(FeesController::class)->prefix('fees')->group(function(){
        Route::get('/membershipfee', 'membershipFee')->name('fees.membershipfee');
        Route::get('/processingfee', 'loanProcessingFee')->name('fees.processingfee');
    });
});

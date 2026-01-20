<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\InstrumentController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Api\PsychometricController;
use App\Http\Controllers\Api\TradeAssistanceController;

/*
|--------------------------------------------------------------------------
| Public Instrument APIs
|--------------------------------------------------------------------------
*/
Route::prefix('instruments')->group(function () {
    Route::get('/', [InstrumentController::class, 'index']);
    Route::get('{symbol}', [InstrumentController::class, 'show']);
    Route::get('{symbol}/candles', [InstrumentController::class, 'candles']);
    Route::get('{symbol}/option-chain', [InstrumentController::class, 'optionChain']);
});

    // Order placement
    Route::post('/orders/place', [OrderController::class, 'place']);

    /*
    |--------------------------------------------------------------------------
    | Psychometrics APIs (PART 8)
    |--------------------------------------------------------------------------
    */
    Route::prefix('psychometrics')->group(function () {
        Route::get('/', [PsychometricController::class, 'overview']);
        Route::get('/explanation', [PsychometricController::class, 'latestExplanation']);
    });

    /*
    |--------------------------------------------------------------------------
    | Trade Assistance APIs (PART 8)
    |--------------------------------------------------------------------------
    */
    Route::prefix('assistance')->group(function () {
        Route::get('/trade/{trade}', [TradeAssistanceController::class, 'show']);
        Route::post('/trade/{trade}/action', [TradeAssistanceController::class, 'updateAction']);
    });


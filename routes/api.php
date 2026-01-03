<?php

use App\Http\Controllers\Api\InstrumentController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\TradeController;
use Illuminate\Support\Facades\Route;



Route::prefix('instruments')->group(function () {

    // Instrument list
    Route::get('/', [InstrumentController::class, 'index']);

    // Instrument detail
    Route::get('{symbol}', [InstrumentController::class, 'show']);

    // Candles
    Route::get('{symbol}/candles', [InstrumentController::class, 'candles']);

    // Option chain
    Route::get('{symbol}/option-chain', [InstrumentController::class, 'optionChain']);
});
Route::post('/orders/place', [OrderController::class, 'place']);
Route::post('/trades/{tradeId}/close', [TradeController::class, 'close']);

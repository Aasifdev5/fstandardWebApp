<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\InstrumentController;

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

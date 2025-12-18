<?php



use App\Http\Controllers\Api\InstrumentController;
use Illuminate\Support\Facades\Route;

Route::apiResource('instruments', InstrumentController::class);
Route::get('instruments/{symbol}/option-chain', [InstrumentController::class, 'optionChain']);
Route::get('instruments/{symbol}/candles', [InstrumentController::class, 'candles']);

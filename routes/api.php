<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\JourneyRouteController;
use App\Http\Controllers\OcrController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/routes', [JourneyRouteController::class, 'index']);
Route::get('/routes/{journeyRoute}', [JourneyRouteController::class, 'show']);

// OCR API Routes
Route::post('/ocr/extract', [OcrController::class, 'extractText']);

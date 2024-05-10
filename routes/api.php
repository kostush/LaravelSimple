<?php

use App\Http\Controllers\StatusController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\Owner;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HealthCheckController;

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
Route::prefix('api')->group(function() {
    Route::prefix('v1')->group(function () {
        Route::get('/', function () {
            return "LeravelTest";
        });
        Route::get('/health-check', [HealthCheckController::class, 'check'])
            ->middleware([
                Owner::class,
                'throttle:health-check'
            ]);
    });
});


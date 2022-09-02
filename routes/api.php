<?php

use App\Http\Controllers\Api\SanctumAuthController;
use App\Http\Controllers\Api\TableController;
use App\Models\Other\Constants\RolesConstants;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::prefix('auth')->group(function () {
    Route::post('login', [SanctumAuthController::class, "login"]);
    Route::get('user', [SanctumAuthController::class, "user"])->middleware('auth:sanctum');
    Route::post('logout', [SanctumAuthController::class, "logout"])->middleware('auth:sanctum');
});

Route::group([
    'prefix' => 'tables',
    'middleware' => 'auth:sanctum' // TODO Reemplazar con el middleware de roles
], static function () {
    Route::get('/', [TableController::class, "index"]);
});

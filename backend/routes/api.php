<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\API\SearchNewsController;
use App\Http\Controllers\API\UserPreferenceController;
use App\Http\Controllers\API\NewsFeedController;


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
Route::controller(RegisterController::class)->group(function () {
    Route::post('register', 'register');
    Route::post('login', 'login');
    Route::post('logout', 'logout');
});
Route::get('/search', [SearchNewsController::class, 'search']);
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::get('/preferences', [UserPreferenceController::class, 'getPreferences']);
    Route::post('/preferences', [UserPreferenceController::class, 'savePreferences']);
    Route::get('/feed', [NewsFeedController::class, 'getFeed']);
});

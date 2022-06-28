<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SessionController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// 認証
Route::get("/register", [UserController::class, "register"]);

Route::middleware("auth:sanctum")->group(function () {
    // UserController
    Route::get("/me", [UserController::class, "me"]);
    Route::put("/me", [UserController::class, "update"]);

    // SessionController
    Route::get("/dust-boxes/{dustBoxId}/sessions", [SessionController::class, "store"]);
    Route::get("/iot/dust-box-pushes", [SessionController::class, "pushes"]);
});

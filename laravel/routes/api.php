<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\MyCostumeController;

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
Route::post("/register", [UserController::class, "register"]);

Route::get("/attach-all-costumes", [MyCostumeController::class, "attachAllCostumesIntoAllUsers"]);

Route::middleware("auth:sanctum")->group(function () {
    // UserController
    Route::get("/me", [UserController::class, "me"]);
    Route::put("/me", [UserController::class, "update"]);
    Route::get("/me/costumes", [MyCostumeController::class, "index"]);
    // SessionController
    Route::post("/dust-boxes/{dustBoxId}/sessions", [SessionController::class, "store"]);
    Route::post("/iot/dust-box-pushes", [SessionController::class, "pushes"]);
});

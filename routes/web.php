<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get("/auth/google", [AuthController::class, "redirectToGoogle"]);
Route::get("/auth/google/callback", [AuthController::class, "handleGoogleCallback"]);
Route::get("/auth/facebook", [AuthController::class, "redirectToFacebook"]);
Route::get("/auth/facebook/callback", [AuthController::class, "handleFacebookCallback"]);

Route::get("/login", [AuthController::class, "showLoginForm"])->name('login');
Route::post("/login", [AuthController::class, "login"]);
Route::get("/register", [AuthController::class, "showRegistrationForm"]);
Route::post("/register", [AuthController::class, "register"]);
Route::get("/logout", [AuthController::class, "logout"]);

Route::get("/", [DashboardController::class, "index"])->middleware(["auth", "verified"]);
Route::get("/article/{id}", [DashboardController::class, "article"])->middleware(["auth", "verified"]);
Route::get("/profile", [ProfileController::class, "index"])->middleware(["auth", "verified"]);
Route::post("/profile", [ProfileController::class, "update"])->middleware(["auth", "verified"]);
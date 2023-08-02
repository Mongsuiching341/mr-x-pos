<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\JwtTokenVerify;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return Inertia('Home');
})->name('home');

//auth
Route::get('/register', [UserController::class, 'show']);
Route::post('/register', [UserController::class, 'create']);
Route::get('/login', [UserController::class, 'loginPage']);
Route::post('/login', [UserController::class, 'userLogin']);
Route::post('/logout', [UserController::class, 'logout']);


//dashboard

Route::get('/dashboard', [DashboardController::class, 'index']);
Route::get('/dashboard/products', [ProductController::class, 'productsPage'])->middleware(JwtTokenVerify::class);
Route::get('/dashboard/products-create', [ProductController::class, 'create'])->middleware(JwtTokenVerify::class);
Route::post('/dashboard/products-create', [ProductController::class, 'store'])->middleware(JwtTokenVerify::class);
Route::get('/dashboard/products/edit/{product}', [ProductController::class, 'update'])->middleware(JwtTokenVerify::class);
Route::post('/dashboard/products/edit/{product}', [ProductController::class, 'edit'])->middleware(JwtTokenVerify::class);

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;

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

Route::get('/', [AuthController::class, 'register']);
Route::get('/dashboard', [HomeController::class, 'dashboard'])->middleware('isAdmin')->name('dashboard');
Route::get('/home',[HomeController::class, 'index'])->name('home');

Route::get('/login', [AuthController::class, 'login'])->name('auth.login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('auth.authenticate');

Route::get('/register', [AuthController::class, 'register'])->name('auth.register');
Route::post('/register', [AuthController::class, 'store'])->name('auth.store');
Route::get('/outregister', [AuthController::class, 'outregister'])->name('auth.outregister');
Route::post('/outregister', [AuthController::class, 'store'])->name('auth.outregister');
Route::delete('/users/{user}',[AuthController::class, 'destroy'])->name('users.destroy');

Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');

Route::get('/categories',[CategoryController::class, 'index'])->name('categories');
Route::post('/categories',[CategoryController::class, 'store'])->middleware('isAdmin')->name('categories.store');
Route::get('/categories/create',[CategoryController::class, 'create'])->middleware('isAdmin')->name('categories.create');
Route::delete('/categories/{category}',[CategoryController::class, 'destroy'])->middleware('isAdmin')->name('categories.destroy');
Route::get('/categories/{category}/edit',[CategoryController::class, 'edit'])->middleware('isAdmin')->name('categories.edit');
Route::PUT('/categories/{category}',[CategoryController::class, 'update'])->middleware('isAdmin')->name('categories.update');

Route::resource('products', ProductController::class);
Route::get('/categories/{category}/products',[ProductController::class, 'getProductsByCategory'])->name('categoryProducts');
Route::get('/search', [ProductController::class, 'search'])->name('searchProduct');

Route::resource('carts', CartController::class);
Route::delete('/cart/{product}',[CartController::class,'removeproduct'])->name('cartproduct.destroy');
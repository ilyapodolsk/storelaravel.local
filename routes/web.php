<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;

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

Route::any('/', [MainController::class, 'index'])->name('index');
Route::any('/delivery', [MainController::class, 'delivery'])->name('delivery');
Route::any('/contacts', [MainController::class, 'contacts'])->name('contacts');
Route::any('/section', [MainController::class, 'section'])->name('section');
Route::any('/sort', [MainController::class, 'sort'])->name('sort');
Route::any('/sortsection', [MainController::class, 'sortSection'])->name('sortsection');
Route::any('/cart', [MainController::class, 'cart'])->name('cart');
Route::post('/cart/update', [MainController::class, 'update'])->name('update.cart');
Route::post('/cart/delete', [MainController::class, 'delete'])->name('delete.cart');
Route::any('/cart/discount', [MainController::class, 'discount'])->name('discount.cart');
Route::any('/order', [MainController::class, 'order'])->name('order');
Route::any('/addorder', [MainController::class, 'addorder'])->name('addorder');
Route::any('/product/{movie}', [MainController::class, 'product'])->name('product');
Route::get('/search', [MainController::class, 'search'])->name('search');
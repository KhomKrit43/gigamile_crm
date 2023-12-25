<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;

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

Route::get('/login', AuthController::class . '@loginForm')->name('login');
Route::post('/login', AuthController::class . '@login');
Route::post('/logout', AuthController::class . '@logout')->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return view('home.index');
    })->name('home.index');

    // Customers
    Route::prefix('customers')->group(function () {
        Route::get('/', CustomerController::class . '@index')->name('customers.index');
        Route::get('/create', CustomerController::class . '@create')->name('customers.create');
        Route::post('/', CustomerController::class . '@store')->name('customers.store');
        Route::get('/{customer}/edit', CustomerController::class . '@edit')->name('customers.edit');
        Route::put('/{customer}', CustomerController::class . '@update')->name('customers.update');
        Route::delete('/{customer}', CustomerController::class . '@destroy')->name('customers.destroy');
    });
});

// Route::get('/', function () {
//     return view('home.index');
// });

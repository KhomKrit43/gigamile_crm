<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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
    });
});

// Route::get('/', function () {
//     return view('home.index');
// });

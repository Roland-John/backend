<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CarouselItemsController;
use App\Http\Controllers\Api\UserController;


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

// Public APIs
Route::post('/login', [AuthController::class, 'login']);
Route::put('/user/{id}', [UserController::class, 'update'])->name('user.update');
// Private APIs
Route::middleware(['auth:sanctum'])->group(function () {
    
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::controller(CarouselItemsController::class)->group(function () {
        Route::get('/carousel',         'index');
        Route::post('/carousel',        'store');
        Route::get('/carousel/{id}',    'show');
        Route::put('/carousel/{id}',    'update');
        Route::delete('/carousel/{id}', 'destroy');    
    });

    Route::controller(UserController::class)->group(function () {
        Route::get('/user',                 'index');
        Route::get('/user/{id}',            'show');
        Route::delete('/user/{id}',         'destroy');
        Route::post('/user',                'store')->name('user.store');
        Route::put('/user/{id}',            'update')->name('user.update');
        Route::put('/user/email/{id}',      'email')->name('user.email');
        Route::put('/user/password/{id}',   'password')->name('user.password');    
    });
});



// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::controller(CarouselItemsController::class)->group(function () {
//     Route::get('/carousel',         'index');
//     Route::post('/carousel',        'store');
//     Route::get('/carousel/{id}',    'show');
//     Route::put('/carousel/{id}',    'update');
//     Route::delete('/carousel/{id}', 'destroy');    
// });


// Route::get('/user', [UserController::class, 'index']);
// Route::get('/user/{id}', [UserController::class, 'show']);
// Route::delete('/user/{id}', [UserController::class, 'destroy']);
// Route::post('/user', [UserController::class, 'store'])->name('user.store');
// Route::put('/user/{id}', [UserController::class, 'update'])->name('user.update');
// Route::put('/user/email/{id}', [UserController::class, 'email'])->name('user.email');
// Route::put('/user/password/{id}', [UserController::class, 'password'])->name('user.password');

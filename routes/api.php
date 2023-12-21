<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\CarouselItemsController;

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

    //Admin APIs
    Route::controller(CarouselItemsController::class)->group(function () {
        Route::get('/carousel',         'index');
        Route::post('/carousel',        'store');
        Route::get('/carousel/{id}',    'show');
        Route::put('/carousel/{id}',    'update');
        Route::delete('/carousel/{id}', 'destroy');    
    });

    //Admin APIs
    Route::controller(UserController::class)->group(function () {
        Route::get('/user',                 'index');
        Route::get('/user/{id}',            'show');
        Route::delete('/user/{id}',         'destroy');
        Route::post('/user',                'store')->name('user.store');
        Route::put('/user/{id}',            'update')->name('user.update');
        Route::put('/user/email/{id}',      'email')->name('user.email');
        Route::put('/user/image/{id}',      'image')->name('user.image');
        Route::put('/user/password/{id}',   'password')->name('user.password');    
    });

    //User Specific APIs
    Route::get('/profile/show',     [ProfileController::class, 'show']);
    Route::put('/profile/image',    [ProfileController::class, 'image'])->name('profile.image');
    
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

<?php

use App\Http\Controllers\Api\AiController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CarouselItemsController;
use App\Http\Controllers\Api\ConversationController;
use App\Http\Controllers\Api\MessageController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\UserController;
use App\Http\Resources\UserCollection;
use App\Models\Conversations;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use PHPUnit\TextUI\Configuration\Group;

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


Route::post('/login', [AuthController::class, 'login'])->name('user.login');
Route::post('/user', [UserController::class, 'store'])->name('user.store');

Route::post('/ocr', [AiController::class, 'ocr'])->name('image.ocr');


Route::middleware('auth:sanctum')->group(function(){
    
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::controller(CarouselItemsController::class)->group(function(){
        Route::get('/carousel',         'index');
        Route::get('/carousel/{id}',    'show');
        Route::post('/carousel',        'store');
        Route::put('/carousel/{id}',    'update');
        Route::delete('/carousel/{id}', 'destroy');
    });

    Route::controller(UserController::class)->group(function(){
        Route::get('/user',         'index');
        Route::delete('/user/{id}', 'destroy');
        Route::get('/user/{id}',    'show');
        Route::put('/user/image/{id}', 'image')->name('user.image');
        
    });

    Route::controller(MessageController::class)->group(function(){
        Route::get('/message',      'index');
        Route::put('/message/{id}', 'update');
        Route::post('/message',     'store');
    });

    Route::controller(ProfileController::class)->group(function(){
        Route::put('/profile/image',    'image')->name('profile.image');
        Route::get('/profile',          'show');
    });
    
});


Route::controller(ConversationController::class)->group(function(){
    Route::get('/conversation',      'index');
    Route::post('/conversation',      'create');
});

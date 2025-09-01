<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\ViewController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\BookCollectionController;
use App\Http\Controllers\Api\ReplyController;
use PHPUnit\Framework\Attributes\PostCondition;

// Route::get('something',[BookCollectionController::class,'something'])->middleware('auth:sanctum');
Route::post('user/login',[PostController::class,'login']);
Route::post('user/register',[PostController::class,'register']);
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('book/collection',[BookCollectionController::class,'getBook']);
    Route::post('book/detail',[BookCollectionController::class,'bookDetail']);
    Route::post('add/cart',[BookCollectionController::class,'addToCart']);
    Route::get('order/cart/{id}',[OrderController::class,'orderCart']);
    Route::post('cart/count',[OrderController::class,'orderCount']);
    Route::post('remove/order',[OrderController::class,'removeOrder']);
    Route::post('comment',[CommentController::class,'comment']);
    Route::get('get/comment',[CommentController::class,'getComment']);
    Route::post('update/user',[PostController::class,'UpdateUserData']);
    Route::get('getPassword/{id}',[PostController::class,'getPassword']);
    Route::post('password',[PostController::class,'updatePassword']);
    Route::post('viewCount',[ViewController::class,'viewCount']);
    Route::post('search',[BookCollectionController::class,'search']);
    Route::post('filter',[BookCollectionController::class,'filter']);
    Route::post('reply',[ReplyController::class,'reply']);
    Route::get('getReply',[ReplyController::class,'getReply']);

});



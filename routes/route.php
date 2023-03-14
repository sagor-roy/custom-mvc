<?php

use App\Base\Route;
use App\Controller\AuthController;
use App\Controller\HomeController;
use App\Controller\StudentController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/view/{id}', [HomeController::class, 'edit']);
Route::post('/user/update', [HomeController::class, 'update']);
Route::post('/user/create', [HomeController::class, 'store']);
Route::get('/user/delete/{id}', [HomeController::class, 'destroy']);

Route::get('/login',[AuthController::class,'index']);
Route::post('/customer/login',[AuthController::class,'login']);
Route::get('/register',[AuthController::class,'register']);
Route::post('customer/store',[AuthController::class,'store']);

Route::get('/404', function () {
    return views('404');
});

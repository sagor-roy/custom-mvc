<?php

use App\Controller\HomeController;
use App\Controller\StudentController;
use Pecee\SimpleRouter\SimpleRouter as Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/view/{id}', [HomeController::class, 'edit']);
Route::post('/user/update', [HomeController::class, 'update']);
Route::post('/user/create', [HomeController::class, 'store']);
Route::get('/user/delete/{id}', [HomeController::class, 'destroy']);


Route::get('/student', [StudentController::class, 'index']);


Route::get('/404', function () {
    return views('404');
});

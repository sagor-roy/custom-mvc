<?php

use App\Base\Route;
use App\Controller\HomeController;

Route::get('/', [HomeController::class, 'index']);
Route::get('/view/{id}', [HomeController::class, 'edit']);
Route::post('/user/update', [HomeController::class, 'update']);
Route::post('/user/create', [HomeController::class, 'store']);
Route::get('/user/delete/{id}', [HomeController::class, 'destroy']);

Route::get('/404', function () {
    return views('404');
});

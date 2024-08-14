<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth:api')->group(function () {
    Route::get('/d', function () {
        return 'welcome';
    });
});

Route::group(['prefix' => 'login'], function(){
    Route::get('', function () {
        return view('welcome');
    })->name('login');
});

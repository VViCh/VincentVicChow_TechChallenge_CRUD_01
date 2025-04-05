<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'home')->name('home');Route::view('/', 'home')->name('home');
Route::view('/create', 'create_product')->name('create_product');
Route::view('/update/{id}', 'update_product')->name('update_product');

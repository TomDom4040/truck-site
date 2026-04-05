<?php

use Illuminate\Support\Facades\Route;

Route::get('/', fn () => view('home'));

Route::view('/about', 'about');
Route::view('/form', 'form');

// на случай заблудших старых ссылок
Route::redirect('/index.html', '/');
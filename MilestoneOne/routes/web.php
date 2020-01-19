<?php

/*
 * |--------------------------------------------------------------------------
 * | Web Routes
 * |--------------------------------------------------------------------------
 * |
 * | Here is where you can register web routes for your application. These
 * | routes are loaded by the RouteServiceProvider within a group which
 * | contains the "web" middleware group. Now create something great!
 * |
 */
Route::get('/', function ()
{
    return view('welcome');
});

Route::get('/welcome', function()
{
   return view('login');         
});

Route::get('/registration', function()
{
   return view('registration'); 
});

// 
Route::post('/login', 'UserController@onLogin');

//
Route::post('/register', 'UserController@onRegister');
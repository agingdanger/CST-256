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

// Routes to the login page view. 
Route::get('/welcome', function()
{
   return view('login');         
});

// Routes to the registration page view. 
Route::get('/registration', function()
{
   return view('registration'); 
});

// Routes to the registerstatus page view. 
Route::get('/registerstatus', function()
{
    return view('registerstatus');
});

// Routes to the controller method onLogin from login page after entering credentials. 
Route::post('/login', 'UserController@onLogin');

// Routes to the controller method onRegister from Registration page after entering credentials. 
Route::post('/register', 'UserController@onRegister');
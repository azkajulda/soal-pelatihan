<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

//Authentication
Auth::routes();
Route::get('/logout','Auth\LoginController@logout')->name('logout');

//home
Route::get('/home', 'HomeController@showHome')->name('home');

//profile
Route::get('/profile', 'ProfileController@showProfile')->name('profile');

//score
Route::get('/score', 'ScoreController@showScore')->name('score');

//training
Route::get('/training', 'TrainingController@showTraining')->name('training');


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

//Manage user
Route::get('/manageUser','HomeController@showManageUser')->name('manageUser');
Route::post('/editAccess/{id}','HomeController@editAccess')->name('editAccess');

//profile
Route::group(['prefix' => 'profile'], function() {
    Route::get('/', 'ProfileController@showMyProfile')->name('profile');
    Route::get('/myProfile', 'ProfileController@showProfile')->name('showProfile');
    Route::post('/addProfile', 'ProfileController@addProfile')->name('addProfile');
});
//score
Route::get('/score', 'ScoreController@showScore')->name('score');

//training
Route::group(['prefix' => 'training'], function() {
    Route::get('/', 'TrainingController@showTraining')->name('training');
    Route::get('/deleteTraining/{id}', 'TrainingController@deleteTraining')->name('deleteTraining');
    Route::get('/getDataTraining/{id}', 'TrainingController@getDataTraining')->name('getDataTraining');
    Route::post('/addTraining', 'TrainingController@addTraining')->name('addTraining');
    Route::post('/updateTraining/{id}', 'TrainingController@updateTraining')->name('updateTraining');

});

//Quiz
Route::group(['prefix' => 'quiz'], function() {
    Route::get('/{id}', 'QuizController@showQuiz')->name('quiz');
    Route::post('/quizzes/{id}','QuizController@addQuizzes')->name('addQuizzes');
});



<?php
Route::get('/', 'GameController@index')->name('home');

Route::get('/register', 'RegistrationController@create');
Route::post('/register', 'RegistrationController@store');

Route::get('/login', 'SessionController@create');
Route::post('/login', 'SessionController@store');
Route::get('/logout', 'SessionController@destroy');

Route::get('/highscores', 'ScoreController@show');
Route::post('/scores', 'ScoreController@store');
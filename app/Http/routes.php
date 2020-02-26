<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/top', "MoviesController@fetchTopRatedPage");
Route::get('/saveGenres', "MoviesController@saveGenres");
Route::get('/latest', "MoviesController@fetchLatest");
Route::get('/list-movies', "MoviesController@listMovies");

Route::get('/e', function () {
    dd(14245);
});

Route::get('/', function () {
    return view('welcome');
});



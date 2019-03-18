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

Route::get('/', 'PagesController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('reviews', 'ReviewsController');

Route::resource('journeys', 'JourneysController');

Route::resource('maps', 'MapsController');

Route::post('/search-reviews', 'SearchController@filterReviews');

Route::post('/search-journey', 'SearchController@filterJourneys');
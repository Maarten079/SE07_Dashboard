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
use Illuminate\Http\Request;
use App\Review;
use App\Journey;
use Carbon\Carbon;

Route::get('/', 'PagesController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('reviews', 'ReviewsController');

Route::resource('journeys', 'JourneysController');

Route::resource('maps', 'MapsController');

Route::post('/search-reviews', 'SearchController@filterReviews');

Route::post('/search-journeys', 'SearchController@filterJourneys');

Route::post('/search-reviews-for-map', 'SearchController@filterReviewsForMap');

Route::post('/review', function(Request $request){
  //dd($request);

  // Create new review object
  $review = new Review;

  $review->message = $request->input('message');
  $review->rating = $request->input('rating');
  $review->img_path = $request->input('img_path');
  $review->vehicle_id = $request->input('vehicle_id');
  $review->lng = $request->input('lng');
  $review->lat = $request->input('lat');

  $journey = Journey::where('journey_date', '<=', Carbon::now())->where('vehicle_id', $request->input('vehicle_id'))->firstOrFail();
  $review->journey_id = $journey->id;

  $review->save();
});
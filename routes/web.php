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
use App\Vehicle;
use Carbon\Carbon;

Route::get('/', 'PagesController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/updateReviews', 'ReviewsController@updateReviews');

Route::resource('reviews', 'ReviewsController');

Route::resource('journeys', 'JourneysController');

Route::resource('maps', 'MapsController');

Route::post('/search-reviews', 'SearchController@filterReviews');

Route::post('/search-journeys', 'SearchController@filterJourneys');

Route::post('/search-reviews-for-map', 'SearchController@filterReviewsForMap');

Route::post('/review', function(Request $request){
  // Check if valid vehicle_id
  $vehicle = Vehicle::find($request->input('vehicle_id'));
  if($vehicle == null){
    return response()->json('Error: Wrong vehicle ID');
  }
  // Create new review object
  $review = new Review;

  $review->message = $request->input('message');
  $review->rating = $request->input('rating');
  $review->vehicle_id = $request->input('vehicle_id');
  $review->lng = $request->input('lng');
  $review->lat = $request->input('lat');
  // Find closes journey
  //$journey = Journey::orderBy('journey_date', 'desc')->where('journey_date', '<=', Carbon::now())->where('vehicle_id', $request->input('vehicle_id'))->firstOrFail(); 
  //$review->journey_id = $journey->id;
  $review->journey_id = null;

  $imageName = '';
  $image = $request->input('img_path');  // Your base64 encoded
  if($image != ''){
    $image = str_replace('data:image/png;base64,', '', $image);
    $image = str_replace(' ', '+', $image);
    $dateTime = str_replace(str_split('-_: '), '',Carbon::now());
    $imageName = $dateTime.'_'.str_random(4).'.'.'png';
    //File::put(storage_path(). '/' . $imageName, base64_decode($image));
    Storage::disk('public')->put($imageName, base64_decode($image));
  }
  $review->img_path = $imageName;

  $review->save();
  return response()->json('Thank you for your review');
});

Route::post('/search-statistics', 'SearchController@filterStatistics');
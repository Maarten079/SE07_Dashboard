<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Review;
use App\Journey;
use App\Charts\userReviewsChart;

class SearchController extends Controller
{
    public function filterReviews(Request $request){
        // Create new query
        $reviews = Review::query();

        // Get the results where $request inputs appear in tupels and store it or them in $reviews
        if($request->input('searchtype') == "guess"){
            if($request->input('id') !== NULL){
                $reviews = $reviews->where('id', 'like', '%'.$request->input('id').'%');
            }

            if($request->input('message') !== NULL){
                $reviews = $reviews->where('message', 'like', '%'.$request->input('message').'%');
            }

            if($request->input('date') !== NULL){

                $reviews = $reviews->where('created_at', 'like', '%'.$request->input('date').'%');
            }

            if($request->input('rating') !== NULL){
                $reviews = $reviews->where('rating', $request->input('rating'));
            }

            if($request->input('vehicle') !== NULL){
                $reviews = $reviews->where('vehicle_id', '%'.$request->input('vehicle').'%');
            }
        }

        // Get the results where $request inputs exactly match in tupels and store it or them in $reviews
        else if($request->input('searchtype') == "exact"){
            if($request->input('id') !== NULL){
                $reviews = $reviews->where('id', $request->input('id'));
            }

            if($request->input('message') !== NULL){
                $reviews = $reviews->where('message', $request->input('message'));
            }

            if($request->input('date') !== NULL){

                $reviews = $reviews->where('created_at', 'like', '%' . $request->input('date') . '%');
            }

            if($request->input('rating') !== NULL){
                $reviews = $reviews->where('rating', $request->input('rating'));
            }

            if($request->input('vehicle') !== NULL){
                $reviews = $reviews->where('vehicle_id', $request->input('vehicle'));
            }
        }

        else{
            Review::report($exception);
        }

        $reviews = $reviews->get();

        dd($reviews);

        return view('reviews.search-results')->with('reviews', $reviews);
    }

    public function filterJourneys(Request $request, Journey $journeys){
        // Create new query
        $journeys = Journey::query();
        
        if($request->input('searchtype') == "guess"){
            if($request->input('id') !== NULL){
                $journeys = $journeys->where('id', '%'.$request->input('id').'%');
            }

            if($request->input('journey') !== NULL){
                $journeys = $journeys->where('journeynumber', '%'.$request->input('journey').'%');
            }

            if($request->input('line') !== NULL){
                $journeys = $journeys->where('lineplanningnumber', '%'.$request->input('line').'%');
            }

            if($request->input('date') !== NULL){
                $journeys = $journeys->where('journey_date', 'like', '%'.$request->input('date').'%');
            }

            if($request->input('vehicle') !== NULL){
                $journeys = $journeys->where('vehicle_id', '%'.$request->input('vehicle').'%');
            }
        }

        else if($request->input('searchtype') == "exact"){
            if($request->input('id') !== NULL){
                $journeys = $journeys->where('id', $request->input('id'));
            }

            if($request->input('journey') !== NULL){
                $journeys = $journeys->where('journeynumber', $request->input('journey'));
            }

            if($request->input('line') !== NULL){
                $journeys = $journeys->where('lineplanningnumber', $request->input('line'));
            }

            if($request->input('date') !== NULL){
                $journeys = $journeys->where('journey_date', 'like', '%' . $request->input('date') . '%');
            }

            if($request->input('vehicle') !== NULL){
                $journeys = $journeys->where('vehicle_id', $request->input('vehicle'));
            }
        }
        else{
            Journey::report($exception);
        }
            // Return the view with the found journeys
            return view('journeys.index')->with('journeys', $journeys);
            }

    public function filterReviewsForMap(Request $request, Review $reviews){
            $reviews = Review::where('created_at', '>=', $request->input('date'))->get();
            return view('maps.index')->with('reviews', $reviews);
    }

    public function filterStatistics(Request $request)
    {
        $negativeReviews = Review::where('rating', '0')->get();
        $neutralReviews = Review::where('rating', '1')->get();
        $positiveReviews = Review::where('rating', '2')->get();

        if($request->input('date') !== NULL){
            $negativeReviews = $negativeReviews->where('created_at', '>=', $request->input('date'));
            $neutralReviews = $neutralReviews->where('created_at', '>=', $request->input('date'));
            $positiveReviews = $positiveReviews->where('created_at', '>=', $request->input('date'));
        }

        if($request->input('journey') !== NULL){
            $negativeReviews = $negativeReviews->where('journey_id', $request->input('journey'));
            $neutralReviews = $neutralReviews->where('journey_id', $request->input('journey'));
            $positiveReviews = $positiveReviews->where('journey_id', $request->input('journey'));
        }
        
        if($request->input('vehicle') !== NULL){
            $negativeReviews = $negativeReviews->where('vehicle_id', $request->input('vehicle'));
            $neutralReviews = $neutralReviews->where('vehicle_id', $request->input('vehicle'));
            $positiveReviews = $positiveReviews->where('vehicle_id', $request->input('vehicle'));
        }

        

        $weekChart = new userReviewsChart;
        $weekChart->labels(['Positive', 'Neutral', 'Negative']);
        $weekChart->dataset('', 'bar', [$positiveReviews->count(), $neutralReviews->count(), $negativeReviews->count()])
            ->color('#0077ff')
            ->backgroundColor('#0077ff');
        $weekChart->loaderColor('#0077ff');
        $weekChart->title('user reviews', '0');
        $weekChart->displayLegend(false);


        return view('pages.index', compact('weekChart'));
    }
}

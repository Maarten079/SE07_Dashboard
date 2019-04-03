<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Review;
use App\Journey;
use App\Charts\userReviewsChart;

class SearchController extends Controller
{
    public function filterReviews(Request $request){
        // Get the results where $request inputs appear in tupels and store it or them in $reviews
        if($request->input('searchtype') == "guess"){
            $reviews = Review::orderBy('created_at', 'DESC')->where('id', 'like', '%' . $request->input('id') . '%')->where('message', 'like', '%' . $request->input('message') . '%')->where('created_at', 'like', '%' . $request->input('date') . '%')->where('rating', 'like', '%' . $request->input('rating') . '%')->where('vehicle_id', 'like', '%' . $request->input('vehicle') . '%');
        }
        // Get the results where $request inputs exactly match in tupels and store it or them in $reviews
        else if($request->input('searchtype') == "exact"){

            $reviews = Review::query();

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

        return view('reviews.search-results')->with('reviews', $reviews);
    }

    public function filterJourneys(Request $request, Journey $journeys){
        if($request->input('searchtype') == "guess"){
            $journeys = Journey::orderBy('journey_date', 'DESC')->where('id', 'like', '%' . $request->input('id') . '%')->where('journeynumber', 'like', '%' . $request->input('journey') . '%')->where('journey_date', 'like', '%' . $request->input('date') . '%')->where('lineplanningnumber', 'like', '%' . $request->input('line') . '%')->where('vehicle_id', 'like', '%' . $request->input('vehicle') . '%');
        }

        else if($request->input('searchtype') == "exact"){
            $journeys = Journey::query();

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

            return view('journeys.index')->with('journeys', $journeys);
            }

    public function filterReviewsForMap(Request $request, Review $reviews){
            $reviews = Review::where('created_at', '>=', $request->input('date'))->get();
            return view('maps.index')->with('reviews', $reviews);
    }

    public function filterStatistics(Request $request, Review $reviews)
    {
        $positivereviews = Review::where('message', 'like', '%' . $request->input('message') . '%')
            ->where('created_at', 'like', '%' . $request->input('date') . '%')
            ->where('rating', '=', 2)
            ->where('vehicle_id', 'like', '%'. $request->input('vehicle') .'%')
            ->count();

        $neutralreviews = Review::where('message', 'like', '%' . $request->input('message') . '%')
            ->where('created_at', 'like', '%' . $request->input('date') . '%')
            ->where('rating', '=', 1)
            ->where('vehicle_id', 'like', '%'. $request->input('vehicle') .'%')
            ->count();

        $negativereviews = Review::where('message', 'like', '%' . $request->input('message') . '%')
            ->where('created_at', 'like', '%' . $request->input('date') . '%')
            ->where('rating', '=', 0)
            ->where('vehicle_id', 'like', '%'. $request->input('vehicle') .'%')
            ->count();

        $weekChart = new userReviewsChart;
        $weekChart->labels(['Positive', 'Neutral', 'Negative']);
        $weekChart->dataset('', 'bar', [$positivereviews, $neutralreviews, $negativereviews])
            ->color('#0077ff')
            ->backgroundColor('#0077ff');
        $weekChart->loaderColor('#0077ff');
        $weekChart->title('user reviews', '0');
        $weekChart->displayLegend(false);


        return view('pages.index', compact('weekChart'));
    }
}

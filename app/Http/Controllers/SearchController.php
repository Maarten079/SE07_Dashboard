<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Review;
use App\Journey;
use App\Charts\userReviewsChart;

class SearchController extends Controller
{
    public function filterReviews(Request $request, Review $reviews){

        if($request->input('searchtype') == "guess"){
            $reviews = Review::orderBy('created_at', 'DESC')->where('id', 'like', '%' . $request->input('id') . '%')->where('message', 'like', '%' . $request->input('message') . '%')->where('created_at', 'like', '%' . $request->input('date') . '%')->where('rating', 'like', '%' . $request->input('rating') . '%')->where('vehicle_id', 'like', '%' . $request->input('vehicle') . '%')->paginate(15);
        }else if($request->input('searchtype') == "exact"){
            // TODO: Complete exact search functionality
            $reviews = Review::orderBy('created_at', 'DESC')->where('id', 'like', '%' . $request->input('id') . '%')->where('message', 'like', '%' . $request->input('message') . '%')->where('created_at', 'like', '%' . $request->input('date') . '%')->where('rating', 'like', '%' . $request->input('rating') . '%')->where('vehicle_id', 'like', '%' . $request->input('vehicle') . '%')->paginate(15);
        }/*else{
            Review::report($exception);
        }*/

        return view('reviews.index')->with('reviews', $reviews);
    }

    public function filterJourneys(Request $request, Journey $journeys){
            if($request->input('searchtype') == "guess"){
                $journeys = Journey::orderBy('journey_date', 'DESC')->where('id', 'like', '%' . $request->input('id') . '%')->where('journeynumber', 'like', '%' . $request->input('journey') . '%')->where('journey_date', 'like', '%' . $request->input('date') . '%')->where('lineplanningnumber', 'like', '%' . $request->input('line') . '%')->where('vehicle_id', 'like', '%' . $request->input('vehicle') . '%')->paginate(15);
            }else if($request->input('searchtype') == "exact"){
                // TODO: Complete exact search functionality
                $journeys = Journey::orderBy('journey_date', 'DESC')->orWhere('id', '=', $request->input('id'))->orWhere('journeynumber', '=', $request->input('journey'))->orWhere('journey_date', '=', $request->input('date'))->orWhere('lineplanningnumber', '=', $request->input('line'))->orWhere('vehicle_id', '=', $request->input('vehicle'))->paginate(15);
            }/*else{
                Journey::report($exception);
            }*/

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
            ->where('rating', '=', 0)
            ->where('vehicle_id', 'like', '%'. $request->input('vehicle') .'%')
            ->count();

        $neutralreviews = Review::where('message', 'like', '%' . $request->input('message') . '%')
            ->where('created_at', 'like', '%' . $request->input('date') . '%')
            ->where('rating', '=', 1)
            ->where('vehicle_id', 'like', '%'. $request->input('vehicle') .'%')
            ->count();

        $negativereviews = Review::where('message', 'like', '%' . $request->input('message') . '%')
            ->where('created_at', 'like', '%' . $request->input('date') . '%')
            ->where('rating', '=', 2)
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

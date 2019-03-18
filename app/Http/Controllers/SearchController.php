<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Review;
use App\Journey;

class SearchController extends Controller
{
    public function filterReviews(Request $request, Review $reviews){
        $reviews = Review::where('id', 'like', '%' . $request->input('id') . '%')->where('message', 'like', '%' . $request->input('message') . '%')->where('created_at', 'like', '%' . $request->input('date') . '%')->where('rating', 'like', '%' . $request->input('rating') . '%')->where('vehicle_id', 'like', '%' . $request->input('vehicle') . '%')->get();

        return view('reviews.index')->with('reviews', $reviews);
        }

        public function filterJourneys(Request $request, Review $journeys){
            $journeys = Journey::where('id', 'like', '%' . $request->input('id') . '%')->where('journeynumber', 'like', '%' . $request->input('journey') . '%')->where('journey_date', 'like', '%' . $request->input('date') . '%')->where('lineplanningnumber', 'like', '%' . $request->input('line') . '%')->where('vehicle_id', 'like', '%' . $request->input('vehicle') . '%')->get();

            return view('journeys.index')->with('journeys', $journeys);
            }
}

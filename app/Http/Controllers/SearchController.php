<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Review;
use App\Journey;

class SearchController extends Controller
{
    public function filterReviews(Request $request, Review $reviews){
        if($request->input('searchtype') == "guess"){
            $reviews = Review::orderBy('created_at', 'DESC')->where('id', 'like', '%' . $request->input('id') . '%')->where('message', 'like', '%' . $request->input('message') . '%')->where('created_at', 'like', '%' . $request->input('date') . '%')->where('rating', 'like', '%' . $request->input('rating') . '%')->where('vehicle_id', 'like', '%' . $request->input('vehicle') . '%')->paginate(15);
        }else if($request->input('searchtype') == "exact"){
            // TODO: Complete exact search functionality
            $reviews = Review::orderBy('created_at', 'DESC')->where('id', 'like', '%' . $request->input('id') . '%')->where('message', 'like', '%' . $request->input('message') . '%')->where('created_at', 'like', '%' . $request->input('date') . '%')->where('rating', 'like', '%' . $request->input('rating') . '%')->where('vehicle_id', 'like', '%' . $request->input('vehicle') . '%')->paginate(15);
        }else{
            Review::report($exception);
        }

        return view('reviews.index')->with('reviews', $reviews);
        }

        public function filterJourneys(Request $request, Review $journeys){
            if($request->input('searchtype') == "guess"){
                $journeys = Journey::orderBy('journey_date', 'DESC')->where('id', 'like', '%' . $request->input('id') . '%')->where('journeynumber', 'like', '%' . $request->input('journey') . '%')->where('journey_date', 'like', '%' . $request->input('date') . '%')->where('lineplanningnumber', 'like', '%' . $request->input('line') . '%')->where('vehicle_id', 'like', '%' . $request->input('vehicle') . '%')->paginate(15);
            }else if($request->input('searchtype') == "exact"){
                // TODO: Complete exact search functionality
                $journeys = Journey::orderBy('journey_date', 'DESC')->orWhere('id', '=', $request->input('id'))->orWhere('journeynumber', '=', $request->input('journey'))->orWhere('journey_date', '=', $request->input('date'))->orWhere('lineplanningnumber', '=', $request->input('line'))->orWhere('vehicle_id', '=', $request->input('vehicle'))->paginate(15);
            }else{
                Journey::report($exception);
            }

            return view('journeys.index')->with('journeys', $journeys);
            }
}

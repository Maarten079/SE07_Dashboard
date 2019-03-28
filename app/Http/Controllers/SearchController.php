<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Review;
use App\Journey;

class SearchController extends Controller
{
    public function filterReviews(Request $request){
        // Get the results where $request inputs appear in tupels and store it or them in $reviews
        if($request->input('searchtype') == "guess"){
            $reviews = Review::orderBy('created_at', 'DESC')->where('id', 'like', '%' . $request->input('id') . '%')->where('message', 'like', '%' . $request->input('message') . '%')->where('created_at', 'like', '%' . $request->input('date') . '%')->where('rating', 'like', '%' . $request->input('rating') . '%')->where('vehicle_id', 'like', '%' . $request->input('vehicle') . '%')->paginate(15);
            
            $reviews = $reviews->withPath('/reviews');
            
            return view('reviews.index')->with('reviews', $reviews);
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

            $reviews = $reviews->paginate(15);

            $reviews = $reviews->withPath('/reviews');

            return view('reviews.index')->with('reviews', $reviews);
        }

        else{
            Review::report($exception);
        }
         
    }

    public function filterJourneys(Request $request, Journey $journeys){
        if($request->input('searchtype') == "guess"){
            
            $journeys = Journey::orderBy('journey_date', 'DESC')->where('id', 'like', '%' . $request->input('id') . '%')->where('journeynumber', 'like', '%' . $request->input('journey') . '%')->where('journey_date', 'like', '%' . $request->input('date') . '%')->where('lineplanningnumber', 'like', '%' . $request->input('line') . '%')->where('vehicle_id', 'like', '%' . $request->input('vehicle') . '%')->paginate(15);
            
            $journeys = $journeys->withPath('/journeys');
            
            return view('journeys.index')->with('journeys', $journeys);

        }else if($request->input('searchtype') == "exact"){
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
            
            $journeys = $journeys->paginate(15);
            
            $journeys = $journeys->withPath('/journeys');

            return view('journeys.index')->with('journeys', $journeys);
        }
        
        else{
            Journey::report($exception);
        }
        }

    public function filterReviewsForMap(Request $request, Review $reviews){
        $reviews = Review::where('created_at', '>=', $request->input('date'))->get();
        return view('maps.index')->with('reviews', $reviews);
    }
}

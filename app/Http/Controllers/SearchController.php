<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Review;

class SearchController extends Controller
{
    public function filter(Request $request, Review $reviews){
        $reviews = Review::where('id', 'like', '%' . $request->input('id') . '%')->where('message', 'like', '%' . $request->input('message') . '%')->where('created_at', 'like', '%' . $request->input('date') . '%')->where('rating', 'like', '%' . $request->input('rating') . '%')->where('vehicle_id', 'like', '%' . $request->input('vehicle') . '%')->get();

        return view('reviews.index')->with('reviews', $reviews);
        }
}

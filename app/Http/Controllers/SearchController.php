<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Review;

class SearchController extends Controller
{
    public function filter(Request $request, Review $reviews){

        $id = $request->input('id');
        $message = $request->input('message');

        $reviews = Review::where('id', 'like', '%' . $id . '%')->orWhere('message', 'like', '%' . $reviews . '%')->get();

        return view('reviews.index')->with('reviews', $reviews);
        }
}

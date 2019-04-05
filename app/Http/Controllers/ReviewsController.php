<?php

namespace App\Http\Controllers;

use App\Journey;
use Illuminate\Http\Request;

// Used to call model functions 
use App\Review;

class ReviewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reviews = Review::orderBy('created_at', 'DESC')->paginate(15);
        return view('reviews.index')->with('reviews', $reviews);
    }

    /*
     * Connect new reviews to journeys
     *
     * */
    public function updateReviews()
    {
        $reviews = Review::where('journey_id', '=', NULL)->get();
        
        foreach ($reviews as $review)
        {
            
            $journey_date_start = Journey::orderBy('journey_date', 'desc')->where('journey_date', '<=', $review->created_at)->where('vehicle_id', $review->vehicle_id)->first();
            
            $journey_date_end = Journey::orderBy('journey_date', 'desc')->where('journey_date', '>', $review->created_at)->where('vehicle_id', $review->vehicle_id)->first();
            if($journey_date_end != NULL && $journey_date_start != NULL){
                $review->journey_id = $journey_date_start->id;
            }
            else{
                $review->journey_id = NULL;
            }
            $review->save();
        }

            return redirect('/reviews');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $review = Review::find($id);
        return view('reviews.show')->with('review', $review);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

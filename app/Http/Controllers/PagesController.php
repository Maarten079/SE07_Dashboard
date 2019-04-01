<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Review;
use App\Charts\userReviewsChart;

class PagesController extends Controller
{
    public function index()
    {
        $weekpositiveReviews = Review::all()->where('created_at', '>', today()->subDays(7))
            ->where('rating', '=', 0)->count();

        $weekneutralReviews = Review::all()->where('created_at', '>', today()->subDays(7))
            ->where('rating', '=', 1)->count();

        $weeknegativeReviews = Review::all()->where('created_at', '>', today()->subDays(7))
            ->where('rating', '=', 2)->count();


        $alltimepositiveReviews = Review::all()->where('rating', '=', 0)->count();

        $alltimeneutralReviews = Review::all()->where('rating', '=', 1)->count();

        $alltimenegativeReviews = Review::all()->where('rating', '=', 2)->count();

        $weekChart = new userReviewsChart;
        $weekChart->labels(['Positive', 'Neutral', 'Negative']);
        $weekChart->dataset('User reviews', 'bar', [$weekpositiveReviews, $weekneutralReviews, $weeknegativeReviews]);
        $weekChart->loaderColor('#0077ff');

        $alltimeChart = new userReviewsChart;
        $alltimeChart->labels(['Positive', 'Neutral', 'Negative']);
        $alltimeChart->dataset('User reviews', 'bar', [$alltimepositiveReviews, $alltimeneutralReviews, $alltimenegativeReviews]);
        $alltimeChart->loaderColor('#0077ff');

        $title = "Welcome to the user response dashboard!";
        return view('pages.index', compact('title', 'weekChart', 'alltimeChart'));
    }
}

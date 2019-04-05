<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Review;
use App\Charts\weekChart;

class PagesController extends Controller
{
    public function index()
    {
        $weekpositiveReviews = Review::all()->where('created_at', '>', today()->subDays(7))
            ->where('rating', '=', 2)->count();

        $weekneutralReviews = Review::all()->where('created_at', '>', today()->subDays(7))
            ->where('rating', '=', 1)->count();

        $weeknegativeReviews = Review::all()->where('created_at', '>', today()->subDays(7))
            ->where('rating', '=', 0)->count();
            
        $weekChart = new weekChart;
        $weekChart->labels(['Negative', 'Neutral', 'Positive'])
                  ->dataset('Week Chart', 'bar', [$weekpositiveReviews, $weekneutralReviews, $weeknegativeReviews])
                  ->backgroundColor(['#FFC8C8', '#FFFFC7', '#C8FFC7']);
        $weekChart->displayLegend(false);

        // $weekChart = new userReviewsChart;
        // $weekChart->labels(['Positive', 'Neutral', 'Negative']);
        // $weekChart->dataset('', 'bar', [$weekpositiveReviews, $weekneutralReviews, $weeknegativeReviews])
        //     ->color('#0077ff')
        //     ->backgroundColor('#0077ff');
        // $weekChart->loaderColor('#0077ff');
        // $weekChart->title(false);
        // $weekChart->displayLegend(false);

        return view('pages.index', compact('weekChart'));
    }
}

@extends('layouts.app')

@section('content')
    <a class="btn btn-default" href="/journeys" role="button">Return</a>
    <hr>
    @if(!is_null($journey))
        <h1>Journey ID: {{$journey->id}}</h1>
        <small>Journey date and time: {{$journey->journey_date}}</small>
    @else
        Journey not found.
    @endif

    <hr>

    <h2>Reviews for this journey:</h2>

    <?php
    use App\Review;
    $reviews = Review::with('journey')->where('journey_id', 'like', $journey->id)->get();
    ?>

    @foreach($reviews as $review)
        <div class="well">
            <a href="/reviews/{{$review->id}}">{{$review->id}}</a></h3>
            <small>Created on {{$review->created_at}}</small>
            <hr>
        </div>
    @endforeach
@endsection
@extends('layouts.app')

@section('content')
    <h1>
        Latest reviews
    </h1>

    @if(count($reviews) > 0)
        @foreach($reviews as $review)
            <div class="well">
                <a href="/reviews/{{$review->id}}">{{$review->id}}</a></h3>
                <small>Created on {{$review->created_at}}</small>
                <hr>
            </div>
        @endforeach
    @else
        <p>No reviews found</p>
    @endif
@endsection
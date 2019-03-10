@extends('layouts.app')

@section('content')
    <h1>
        Latest reviews
    </h1>
    <form action="{{url('/search')}}" method="POST" class="mb-3">
        @csrf
        <input type="text" name="id" placeholder="id">
        <input type="text" name="message" placeholder="message">
        <input class="btn-success" type="submit" value="Submit">
    </form>
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
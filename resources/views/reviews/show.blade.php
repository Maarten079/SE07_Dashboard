@extends('layouts.app')

@section('content')
    <a class="btn btn-default" href="/reviews" role="button">Return</a>
    <hr>
    @if(!is_null($review))
        <h1>Review ID: {{$review->id}}</h1>
        <p>{{$review->message}}</p>
        <p>{{$review->rating}}</p>
        <p>{{$review->image_path}}</p>
        <p>{{$review->vehicle}}</p>
        <small>Created on {{$review->created_at}}</small>
    @else
        review not found
    @endif
@endsection
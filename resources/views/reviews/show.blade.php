@extends('layouts.app')

@section('content')
    <a class="btn btn-default" href="/reviews" role="button">Return</a>
    <hr>
    @if(!is_null($review))
        <h1>Review ID: {{$review->id}}</h1>
        <small>message:</small>
        <p>{{$review->message}}</p>
        <small>rating:</small>
        <p>{{$review->rating}}</p>
        <small>img:</small>
        <p><?php
        $img = $review->img_path;
        echo '<img src="data:image/jpeg;base64,' . $img . '" />';
        ?></p>
        <small>vehicle:</small>
        <p>{{$review->vehicle_id}}</p>
        <small>coordinates:</small>
        <p>{{$review->coordinates}}</p>
        <small>Created on {{$review->created_at}}</small>
    @else
        review not found
    @endif
@endsection


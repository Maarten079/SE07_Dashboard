@extends('layouts.app') 
@section('content')
<h1>
    Latest reviews
</h1>
<p>
    <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseFilters" aria-expanded="false"
        aria-controls="collapseFilters">
        Filters
        </button>
</p>

    <div class="collapse mb-3" id="collapseFilters">
        <div class="card card-body">
            <form action="{{url('/search-reviews')}}" method="POST" class="mb-3">
                @csrf
                <div class="form-group">
                    <label for="idInput">id:</label>
                    <input class="form-control mb-3" id="idInput" name="id" placeholder="review id">
                </div>
                <div class="form-group">
                    <label for="messageInput">message:</label>
                    <input class="form-control mb-3" id="messageInput" type="text" name="message" placeholder="review message">
                </div>
                <div class="form-group">
                    <label for="dateInput">date:</label>
                    <input class="form-control mb-3" id="dateInput" type="date" name="date">
                </div>
                <div class="form-group">
                    <label for="vehicleInput">vehicle:</label>
                    <input class="form-control mb-3" id="vehicleInput" type="text" name="vehicle" placeholder="vehicle number">
                </div>
                <div class="form-group">
                    <label for="ratingInput">rating:</label>
                    <select class="form-control mb-3" id="ratingInput" name="rating">
                        <option></option>
                        <option>Good</option>
                        <option>Neutral</option>
                        <option>Bad</option>
                    </select>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>

@if(count($reviews) > 0) @foreach($reviews as $review)
<div class="well">
    <a href="/reviews/{{$review->id}}">{{$review->id}}</a></h3>
    <br>
    <small>Created on {{$review->created_at}}</small>
    <br>
    <small>rating: {{$review->rating}}</small>
    <br>
    <small>img: {{$review->image_path}}</small>
    <br>
    <small>vehicle: {{$review->vehicle_id}}</small>
    <br>
    <small>coordinates: {{$review->coordinates}}</small>
    <hr>
</div>
@endforeach @else
<p>No reviews found</p>
@endif
@endsection
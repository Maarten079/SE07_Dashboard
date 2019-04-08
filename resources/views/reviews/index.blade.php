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
                        <option value=2>Good</option>
                        <option value=1>Neutral</option>
                        <option value=0>Bad</option>
                    </select>
                <div class="form-group">
                    Search type:<br>
                    <input type="radio" name="searchtype" value="guess" checked="true"> Guess<br>
                    <input type="radio" name="searchtype" value="exact"> Exact<br>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>

@if(!is_null($reviews))
    @foreach($reviews as $review)
    <div class="well">
        @if(isset($review->id))
            <a href="/reviews/{{$review->id}}">{{$review->id}}</a></h3>
            <br>
        @endif

        @if(isset($review->created_at))
            <small>Created on {{$review->created_at}}</small>
            <br>
        @endif

        @if(isset($review->rating))
            <small>rating: 
                <?php
                    if ($review->rating == '0')
                        echo 'bad'; 
                    elseif ($review->rating == '1')
                        echo 'neutral'; 
                    elseif ($review->rating == '2')
                        echo 'good';
                ?>
            </small>
            <br>
        @endif

        @if(isset($review->img_path))
            <small>img: {{$review->img_path}}</small>
            <br>
        @endif

        @if(isset($review->vehicle_id))
            <small>vehicle: {{$review->vehicle_id}}</small>
            <br>
        @endif

        @if(isset($review->lng))
            <small>lng: {{$review->lng}}</small>
        @endif

        @if(isset($review->lat))
            <small>lat: {{$review->lat}}</small>
        @endif
        <hr>
    </div>
    @endforeach
    {{ $reviews->links() }}

    @else
    <p>No reviews found</p>

@endif
@endsection
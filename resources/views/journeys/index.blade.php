@extends('layouts.app')

@section('content')
    <h1>
        Latest journeys
    </h1>
    <p>
        <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseFilters" aria-expanded="false" aria-controls="collapseFilters">
        Filters
        </button>
    </p>

    <div class="collapse mb-3" id="collapseFilters">
        <div class="card card-body">
            <form action="{{url('/search-journey')}}" method="POST" class="mb-3">
                @csrf
                <div class="form-group">
                    <label for="idInput">id:</label>
                    <input class="form-control mb-3" id="idInput" name="id" placeholder="review id">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
    
    @if(count($journeys) > 0)
        @foreach($journeys as $journey)
            <div class="well">
                <a href="/journeys/{{$journey->id}}">{{$journey->id}}</a></h3>
                <small>Created on {{$journey->created_at}}</small>
                <hr>
            </div>
        @endforeach
    @else
        <p>No reviews found</p>
    @endif
@endsection
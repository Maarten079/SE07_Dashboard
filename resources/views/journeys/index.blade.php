@extends('layouts.app') 
@section('content')
<h1>
    Latest journeys
</h1>
<p>
    <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseFilters" aria-expanded="false"
        aria-controls="collapseFilters">
        Filters
        </button>
</p>

<div class="collapse mb-3" id="collapseFilters">
    <div class="card card-body">
        <form action="{{url('/search-journeys')}}" method="POST" class="mb-3">
            @csrf
            <div class="form-group">
                <label for="idInput">id:</label>
                <input class="form-control mb-3" id="idInput" name="id" placeholder="id">
            </div>
            <div class="form-group">
                <label for="journeyInput">journey:</label>
                <input class="form-control mb-3" id="journeyInput" name="journey" placeholder="journey number">
            </div>
            <div class="form-group">
                <label for="linenumberInput">line number:</label>
                <input class="form-control mb-3" id="linenumberInput" name="line" placeholder="line number">
            </div>
            <div class="form-group">
                <label for="vehicleInput">vehicle:</label>
                <input class="form-control mb-3" id="journeyInput" name="vehicle" placeholder="vehicle id">
            </div>
            <div class="form-group">
                <label for="dateInput">date:</label>
                <input class="form-control mb-3" id="dateInput" type="date" name="date">
            </div>
            <div class="form-group">
                Search type:<br>
                <input type="radio" name="searchtype" value="guess" checked="true"> Guess<br>
                <input type="radio" name="searchtype" value="exact"> Exact<br>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
@if(!is_null($journeys))
    @if(count($journeys)>0) 
        @foreach($journeys as $journey)
        <div class="well">
            <a href="/journeys/{{$journey->id}}">{{$journey->id}}</a></h3>
            <br>
            <small>Journey date and time: {{$journey->journey_date}}</small>
            <br>
            <small>Journey number: {{$journey->journeynumber}}</small>
            <br>
            <small>Line number: {{$journey->lineplanningnumber}}</small>
            <br>
            <small>Vehicle: {{$journey->vehicle_id}}</small>
            <hr>
        </div>
        @endforeach 
        {{ $journeys->links() }}
    @else
        <p>No journeys found</p>
    @endif
@endif
@endsection
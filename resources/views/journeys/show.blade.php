@extends('layouts.app')

@section('content')
    <a class="btn btn-default" href="/journeys" role="button">Return</a>
    <hr>
    @if(!is_null($journey))
        <h1>journey ID: {{$journey->id}}</h1>
        <small>Created on {{$journey->created_at}}</small>
    @else
        journey not found
    @endif
    <br>
@endsection
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            {{ $title }}
        </div>
        <div class="row justify-content-center">
        <div class="col-md-5">

            <div class="card">
                <div class="card-header">User reviews of last week</div>

                <div class="card-body">
                    {!! $weekChart->container() !!}
                </div>
            </div>
        </div>

        <div class="col-md-5">

            <div class="card">
                <div class="card-header">User reviews of all time</div>
                <div class="card-body">
                    {!! $alltimeChart->container() !!}
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
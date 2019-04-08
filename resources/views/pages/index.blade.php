@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <p>Welcome to the user response dashboard!</p>
        </div>
        <p>
            <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseFilters" aria-expanded="false"
                    aria-controls="collapseFilters">
                Filters
            </button>
        </p>

        <div class="collapse mb-3" id="collapseFilters">
            <div class="card card-body">
                <form action="{{url('/search-statistics')}}" method="POST" class="mb-3">
                    @csrf
                    <div class="form-group">
                        <label for="journeyInput">journey:</label>
                        <input class="form-control mb-3" id="journeyInput" type="text" name="journey" placeholder="journey number">
                    </div>
                    <div class="form-group">
                        <label for="dateInput">date:</label>
                        <input class="form-control mb-3" id="dateInput" type="date" name="date">
                    </div>
                    <div class="form-group">
                        <label for="vehicleInput">vehicle:</label>
                        <input class="form-control mb-3" id="vehicleInput" type="text" name="vehicle" placeholder="vehicle number">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>

            </div>
        </div>
        <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card">
                <div class="card-header">User reviews:</div>

                <div class="card-body">
                    {!! $weekChart->container() !!}
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- render chart -->
    {!! $weekChart->script() !!}

@endsection
@extends('layouts.app')
@section('content')
<h1>
  Map
</h1>
<form action="{{url('/search-reviews-for-map')}}" method="POST" class="mb-3">
  @csrf
  <div class="form-group">
    <label for="dateInput">Show reviews since:</label>
    <input class="form-control mb-3" id="dateInput" type="date" name="date" required>
  </div>
  <button type="submit" class="btn btn-primary mb-2">Submit</button>
</form>

<!--The div element for the map -->
<div id="map"></div>
<script>
  // Initialize and add the map
function initMap() {
  // The location of Uluru
  var mapCenter = {lat: 52.07667, lng: 4.4};
  // The map, centered at The Hague
  var map = new google.maps.Map(
      document.getElementById('map'), {zoom: 11, center: mapCenter});

      var infowindow = new google.maps.InfoWindow();

      @foreach($reviews as $review)
        @if(!is_null($review->lat) && !is_null($review->lng))

        // Info Window content
        var contentString = '<div id="content">'+
      '<div id="siteNotice">'+
      '</div>'+
      '<h1 id="firstHeading" class="firstHeading"><a href="/reviews/{{$review->id}}">{{$review->id}}</a></h1>'+
      '<div id="bodyContent">'+
      '<p></h1>'+
        '<small>message:</small>' +
        '<p>{{$review->message}}</p>' +
        '<small>rating:</small>' +
        '<p><?php
              if ($review->rating == '0')
                echo 'bad'; 
              elseif ($review->rating == '1')
                echo 'neutral'; 
              elseif ($review->rating == '2')
                echo 'good';
            ?></p>' +
        '<small>img:</small>' +
        '<p>{{$review->image_path}}</p>' +
        '<small>vehicle:</small>' +
        '<p>{{$review->vehicle}}</p>' +
        '<small>coordinates:</small>' +
        '<p>{{$review->lat}} , {{$review->lng}}</p>' +
        '<small>Created on {{$review->created_at}}</small></p>' +
      '</div>'+
      '</div>';

          // The marker, positioned at Uluru
          var coords = {lat: {{$review->lat}}, lng: {{$review->lng}}}
          var icon = {
                        url: "", // url
                        scaledSize: new google.maps.Size(32, 32), // scaled size
                        origin: new google.maps.Point(0,0), // origin
                        anchor: new google.maps.Point(16, 32) // anchor
                      };
          @if($review->rating == '0')
              icon.url = "http://maps.google.com/mapfiles/kml/paddle/red-blank.png";
          @elseif ($review->rating == '1')
              icon.url = "http://maps.google.com/mapfiles/kml/paddle/ylw-blank.png";
          @elseif ($review->rating == '2')
              icon.url = "http://maps.google.com/mapfiles/kml/paddle/grn-blank.png"
          @endif
          var marker = new google.maps.Marker({position: coords, map: map, icon:icon, info: contentString});
          marker.addListener('click', function() {
            infowindow.close();
            infowindow.setContent(this.info);
            infowindow.open(map, this);
          });
        @else
          console.log('We found a review without coords!');
        @endif
      @endforeach
}

</script>
<!--Load the API from the specified URL
    * The async attribute allows the browser to render the page while the API loads
    * The key parameter will contain your own API key (which is not needed for this tutorial)
    * The callback parameter executes the initMap() function
    -->
<script async defer src="https://maps.googleapis.com/maps/api/js?key={{env('GOOGLE_MAPS_API', null)}}&callback=initMap">

</script>
@endsection
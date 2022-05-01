@extends('layouts.app')
@section('pageTitle', 'About')
@section('content')
<div class="container">
    <div class="row">

         <h1>About Page</h1>

			<p><b> Today is: {{ $today }} </b></p>

     <div class="w3-container">
<p>Readability is an important reason for the populaity of flat typography in web design.</p>
</div>

<div class="w3-container">
<h3>W3.CSS Typography</h3>
<p>Simplicity and readability is the most important reason for flat design.
Simplicity and readability is the most important reason for flat design.
Simplicity and readability is the most important reason for flat design.</p>
</div>

<div class="w3-container"
style="font-family:Arial, Helvetica, sans-serif">
<h3>Normal Sans Serif</h3>
<p>Simplicity and readability is the most important reason for flat design.
Simplicity and readability is the most important reason for flat design.
Simplicity and readability is the most important reason for flat design.</p>
</div>

<div class="w3-container"
style="font-family:'Times New Roman', Times, serif">
<h3>Normal Serif</h3>
<p>Simplicity and readability is the most important reason for flat design.
Simplicity and readability is the most important reason for flat design.
Simplicity and readability is the most important reason for flat design.</p>
</div>


 <div id="map" style="width:800px;height:400px;"></div>
</div>
</div>

    <script>
function myMap() {
  var Mures = new google.maps.LatLng(46.5379237,24.5886);
  var mapCanvas = document.getElementById("map");
  var mapOptions = {

    center: Mures, zoom: 18,
     zoomControl: true,
   mapTypeId: google.maps.MapTypeId.HYBRID,
     mapTypeControlOptions: {

      style: google.maps.MapTypeControlStyle.DROPDOWN_MENU,
      position: google.maps.ControlPosition.TOP_CENTER
    }

  };
  var map = new google.maps.Map(mapCanvas, mapOptions);
  var marker = new google.maps.Marker({position:Mures});
  marker.setMap(map);




  var infowindow = new google.maps.InfoWindow({
    content: "Targu Mures Romania"
  });
  infowindow.open(map,marker);
}
</script>
 <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCtP3P6jFfMtemhiaJQWXK-bMgIXhv9g68M&callback=myMap"></script>

@endsection

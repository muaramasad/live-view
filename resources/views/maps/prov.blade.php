@extends('layouts.app')
@section('content')
{{ Breadcrumbs::render('prov', $division,$prov) }}
<div class="columns">
	<div class="column">
		<div class="card">
			<header class="card-header">
				<p class="card-header-title">
					{{$prov->province_name}}
				</p>
			</header>
			<div class="card-content">
				<!-- Map menggunakan Package 
				<div class="map">
					<div id="mapdiv" style="width: 100%; height: 600px;">
						{{-- {!! Mapper::render() !!} --}}
					</div>
				</div>
				-->
				<div id="map" style="width: 100%;height: 450px"></div>
				<script>
				function initMap() {
					var idnCor = {lat: {{$prov->province_cor_x}}, lng: {{$prov->province_cor_y}}};
					var locations = {!! json_encode($siteLocation) !!};
			        var map = new google.maps.Map(document.getElementById('map'), {
			          zoom: {{$prov->province_zoom}},
			          center: idnCor
			        });

			        var infowindow = new google.maps.InfoWindow();
    				var marker;
    				var i;
 					
					var markers = locations.map(function(location, i) {
						marker = new google.maps.Marker({
							position: new google.maps.LatLng(location[1], location[2]),
				        	map: map,
				        	icon: '{{ asset('/images/japfa_pointer.png') }}'
						});
						google.maps.event.addListener(marker, 'click', function(marker, i) {
    						window.location.href = '/map/site/'+location[3];
  						});
						return marker;
					});

					// Add a marker clusterer to manage the markers.
					var markerCluster = new MarkerClusterer(map, markers,
					{imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'});
      	        
				}
				</script>
				<script src="https://maps.googleapis.com/maps/api/js?key={{env('GOOGLE_API_KEY')}}&callback=initMap" async defer></script>
				<script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js">
			</div>
		</div>
	</div>
</div>
@endsection
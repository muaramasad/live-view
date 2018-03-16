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

    				var icon = {
        				url: '{{ asset('/images/japfa_pointer.png') }}', // url
        				scaledSize: new google.maps.Size(32, 40)
    				};
 					
					var markers = locations.map(function(location, i) {
						marker = new google.maps.Marker({
							position: new google.maps.LatLng(location[1], location[2]),
				        	map: map,
				        	icon: icon
						});
						var infoWindow = new google.maps.InfoWindow(), marker, i;
						infoWindow.setContent(location[0]);
                		infoWindow.open(map, marker);
						google.maps.event.addListener(marker, 'click', function(marker, i) {
    						window.location.href = '/map/site/'+location[3];
  						});
						return marker;
					});

					// Add a marker clusterer to manage the markers.
					var markerCluster = new MarkerClusterer(map, markers,
					{imagePath: '{{ asset('/images/m/') }}'});
      	        
				}
				</script>
				<script src="https://maps.googleapis.com/maps/api/js?key={{env('GOOGLE_API_KEY')}}&callback=initMap" async defer></script>
				<script type="text/javascript" src="{{ asset('js/clusters.js') }}"></script>
			</div>
		</div>
	</div>
</div>
@endsection
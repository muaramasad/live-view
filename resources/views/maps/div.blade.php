@extends('layouts.app')
@section('content')
{{ Breadcrumbs::render('division', $division) }}
<div class="columns">
	<div class="column">
		<div class="card">
			<header class="card-header">
				<p class="card-header-title">
					{{$division->division_name}}
				</p>
			</header>
			<div class="card-content">
				{{-- <div class="field is-grouped is-grouped-multiline">
					@if($areas->isEmpty())
					@else
					<p class="control">
						<button class="btn-all button is-small">
						All Sites
						</button>
					</p>
					@endif
					@foreach($areas as $area)
					@if($area->has('sites')->find($area->id))
					<p class="control">
						<button class="btn-area button is-small" data-id="{{$area->id}}">
						{{$area->area_name}}
						</button>
					</p>
					@endif
					@endforeach
				</div> --}}
				<!-- Map menggunakan Package -->
				<!-- <div class="map">
						{{-- <div id="mapdiv" style="width: 100%; height: 600px;">
								{!! Mapper::render() !!}
						</div> --}}
				</div> -->
				<div id="map" style="width: 100%;height: 450px"></div>
				<script>
				function initMap() {
					var idnCor = {lat: -1.7922201, lng: 116.9502052};
					var locations = {!! json_encode($divLocation) !!};
			        var map = new google.maps.Map(document.getElementById('map'), {
			          zoom: 5,
			          center: idnCor
			        });

			        map.setOptions({draggable: false, zoomControl: false, scrollwheel: false, disableDoubleClickZoom: true});

			        var infowindow = new google.maps.InfoWindow();
    				var marker, i;

    				for (i = 0; i < locations.length; i++) {
				      marker = new google.maps.Marker({
				        position: new google.maps.LatLng(locations[i][1], locations[i][2]),
				        map: map,
				        icon: '{{ asset('/images/japfa_pointer.png') }}',
				      });
				      	google.maps.event.addListener(marker, 'mouseover', (function(marker, i) {
				      		return function() {
					      		content = '<h4>'+locations[i][0]+'</h4>';
								infowindow = new google.maps.InfoWindow({
	            				content: content,
	            				maxWidth: 200
	        					});
	    						infowindow.open(map, this);
    						}
  						})(marker, i));
  						google.maps.event.addListener(marker, 'mouseout', function(marker, i) {
    						infowindow.close();
  						});
				      	google.maps.event.addListener(marker, 'click', (function(marker, i) {
					        return function() {
					          // infowindow.setContent(locations[i][0]);
					          // infowindow.open(map, marker);
					          window.location.href = '/map/division/{{$division->id}}/province/'+locations[i][3];
					        }
				      	})(marker, i));
				    }
			        
				}
				</script>
				<script src="https://maps.googleapis.com/maps/api/js?key={{env('GOOGLE_API_KEY')}}&callback=initMap" async defer></script>
			</div>
		</div>
	</div>
</div>
@endsection
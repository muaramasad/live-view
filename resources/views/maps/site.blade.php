@extends('layouts.app')
@section('content')
{{ Breadcrumbs::render('site',$division,$site) }}
<div class="columns">
	<div class="column">
		<div class="card">
			<header class="card-header">
				<p class="card-header-title">
					{{$site->site_name}}
				</p>
			</header>
			<div class="card-content">
				{{-- <div class="map">
					<div id="mapdiv" style="width: 100%; height: 600px;">
						{!! Mapper::render() !!}
					</div>
				</div> --}}
				<div id="map" style="width: 100%;height: 450px"></div>
				<script>
				function initMap() {
					var siteCor = {lat: {{$site->cor_x}}, lng: {{$site->cor_y}}};
					var locations = {!! json_encode($camsLocation) !!};
			        var map = new google.maps.Map(document.getElementById('map'), {
			          zoom: 18,
			          center: siteCor,
			          mapTypeId: 'satellite'
			        });

			        var infowindow = new google.maps.InfoWindow();
    				var marker;
    				var i;
 					
    				var icon = {
        				url: '{{ asset('/images/placeholder.svg') }}', // url
        				scaledSize: new google.maps.Size(24, 24)
    				};

					var markers = locations.map(function(location, i) {
						marker = new google.maps.Marker({
							position: new google.maps.LatLng(location[1], location[2]),
				        	map: map,
				        	icon: icon,
						});
						google.maps.event.addListener(marker, 'click', function(marker, i) {
    						window.location.href = '/map/site/'+location[3];
  						});
						return marker;
					});

					// Add a marker clusterer to manage the markers.
					// var markerCluster = new MarkerClusterer(map, markers,
					// {imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'});
      	        
				}
				</script>
				<script src="https://maps.googleapis.com/maps/api/js?key={{env('GOOGLE_API_KEY')}}&callback=initMap" async defer></script>
			</div>
		</div>
	</div>
</div>
<div class="modal">
	<div class="modal-background"></div>
	<div class="modal-content">
		<h3 id="camName" class="is-size-4 is-white"></h3>
		<img id="test">
	</div>
	<button class="modal-close is-large" aria-label="close"></button>
</div>
<script>
		var newYearCountdown;
		function showInfo(){
			$(".gm-style-iw").css("display: block");
		}
		function showModal(id,path,camName){
			$(".modal").addClass("is-active");
			var counter = 1;
			var date = moment(new Date());
			date = date.subtract(3, 'minutes');
    		newYearCountdown = setInterval(function(){
    		if (counter === 601) {
				counter = 1;
				date = date.add(1, 'minutes');
			}
        	var newImg = $('#test');
        	var nameCam = $('#camName');
        	var filename = '/video/'+path+'/ip-'+date.format("DDMMYYYY__HHmm")+'-'+counter+'.jpeg';
        	newImg.attr("src", filename);
        	nameCam.text(camName);
        	console.log(filename);
        	counter++;
			}, 1000/10);
		}
		$(document).on('click', '.modal-close', function() {
			 $(".modal").removeClass("is-active");
			 clearInterval(newYearCountdown);
		     return false;
		});
		$(document).on('click', '.notification > button.delete', function() {
		    $(this).parent().addClass('is-hidden');
		    return false;
		});
		</script>
@endsection
@extends('layouts.app')
@section('content')
{{ Breadcrumbs::render('site',$division,$prov,$site) }}
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
				<div id="map" style="width: 100%;height: 480px"></div>
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
<script src="https://maps.googleapis.com/maps/api/js?key={{env('GOOGLE_API_KEY')}}"></script>
<script>
var locations = {!! json_encode($camsLocation) !!};
var siteIp = '{{$site->url_1}}';
var map;
var checkPing = function(ip){
	var data;
	$.ajax({
	async: false,
	url: "/api/cctv/status/" + ip,
	type: 'GET',
	success: function(response) {
		data = response;
	},
	error: function() {
		console.log("error");
	}
	});
	return data;
}
function initMap() {
	var siteCor = {lat: {{$site->cor_x}}, lng: {{$site->cor_y}}};
	map = new google.maps.Map(document.getElementById('map'), {
	zoom: 17.5,
	maxZoom:18,
    minZoom:17,
	center: siteCor,
	mapTypeId: 'satellite'
	});
	map.setOptions({draggable: true, zoomControl: true, scrollwheel: false, disableDoubleClickZoom: true});
}
function addMarker(){
	var infowindow = new google.maps.InfoWindow();
	var marker;
	var i;
	var content;
	var iconOnline = {
	url: '{{ asset('/images/cam_on.svg') }}', // url
	scaledSize: new google.maps.Size(24, 24)
	};
	var iconOffline = {
		url: '{{ asset('/images/cam_off.svg') }}', // url
	scaledSize: new google.maps.Size(24, 24)
	}

	if(checkPing(siteIp) === 'online' ){
		locations.map(function(location, i) {
		marker = 1;
		$content = '<h4>'+location[0]+'</h4><p>IP Address: '+location[3]+'</p>';
		if(checkPing(location[3]) === 'online'){
				marker = new google.maps.Marker({
					position: new google.maps.LatLng(location[1], location[2]),
					map: map,
					icon: iconOnline,
				});
		google.maps.event.addListener(marker, 'mouseover', function(marker, i) {
			infowindow = new google.maps.InfoWindow({
			content: '<h4>'+location[0]+'</h4><p>IP Address: '+location[3]+'</p>',
			maxWidth: 200
			});
			infowindow.open(map, this);
			});
		google.maps.event.addListener(marker, 'mouseout', function(marker, i) {
			infowindow.close();
			});
		google.maps.event.addListener(marker, 'click', function(marker, i) {
			showModal(1,location[3].split('.').join(""),location[0]);
			});
			console.log('online '+location[3])
			} else {
				marker = new google.maps.Marker({
		position: new google.maps.LatLng(location[1], location[2]),
		map: map,
		icon: iconOffline,
		});
		google.maps.event.addListener(marker, 'mouseover', function(marker, i) {
			infowindow = new google.maps.InfoWindow({
			content: '<h4>'+location[0]+'</h4><p>IP Address: '+location[3]+'</p>',
			maxWidth: 200
			});
			infowindow.open(map, this);
			});
		google.maps.event.addListener(marker, 'mouseout', function(marker, i) {
			infowindow.close();
			});
			}
			console.log('offline '+location[3])
		return marker;
		});
		} else {
		locations.map(function(location, i) {
		marker = 1;
		$content = '<h4>'+location[0]+'</h4><p>IP Address: '+location[3]+'</p>';
		marker = new google.maps.Marker({
		position: new google.maps.LatLng(location[1], location[2]),
		map: map,
		icon: iconOffline,
		});
		google.maps.event.addListener(marker, 'mouseover', function(marker, i) {
			infowindow = new google.maps.InfoWindow({
			content: '<h4>'+location[0]+'</h4><p>IP Address: '+location[3]+'</p>',
			maxWidth: 200
			});
			infowindow.open(map, this);
			});
		google.maps.event.addListener(marker, 'mouseout', function(marker, i) {
			infowindow.close();
			});
		});
		console.log('offline '+siteIp)
	}
}
setTimeout(function() {
	initMap();
}, 500);
setTimeout(function() {
	addMarker();
}, 1000);
</script>
<script>
	var countdown;
	function showInfo(){
		$(".gm-style-iw").css("display: block");
	}
	function showModal(id,path,camName){
		$(".modal").addClass("is-active");
		var counter = 1;
		var date = moment(new Date());
		date = date.subtract(3, 'minutes');
		countdown = setInterval(function(){
		if (counter === 241) {
			counter = 1;
			date = date.add(1, 'minutes');
		}
		var newImg = $('#test');
		var nameCam = $('#camName');
		var filename = 'http://{{$site->url_1}}/'+path+'/ip-'+counter+'.jpeg';
		newImg.attr("src", filename);
		nameCam.text(camName);
		console.log(filename);
		counter++;
		}, 1000/2);
	}
		$(document).on('click', '.modal-close', function() {
			$(".modal").removeClass("is-active");
			clearInterval(countdown);
		return false;
		});
		$(document).on('click', '.notification > button.delete', function() {
		$(this).parent().addClass('is-hidden');
		return false;
		});
</script>
@endsection
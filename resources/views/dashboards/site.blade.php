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
				<div id="map" style="width: 100%;height: 480px"></div>
			</div>
		</div>
	</div>
</div>
<div class="modal">
	<div class="modal-background"></div>
	<div class="modal-content">
		<h3 id="camName" class="is-size-4 is-white"></h3>
		<img id="imgCam">
	</div>
	<button class="modal-close is-large" aria-label="close"></button>
</div>
<script src="https://maps.googleapis.com/maps/api/js?key={{env('GOOGLE_API_KEY')}}"></script>
<script>
var locations = {!! json_encode($camsLocation) !!};
var siteIp = '{{$site->url_1}}';
var map;
// Check if cctv is online
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
// Run ffmpeg to grab cctv snapshoot
var playCam = function(ip){
	var res;
	$.ajax({
	async: false,
	url: "/api/cctv/play/" + ip,
	type: 'GET',
	success: function(response) {
		res = response;
		console.log(response);
	},
	error: function() {
		console.log("error");
	}
	});
	return res;
}
// Stop ffmpeg
var stopCam = function(pid,folder,ip){
	var res;
	$.ajax({
	async: false,
	url: "/api/cctv/stop/" + pid + "/" + folder + "/" + ip,
	type: 'GET',
	success: function(response) {
		res = response;
		console.log(response);
	},
	error: function() {
		console.log("error");
	}
	});
	return res;
}
// Directory check if file exist on video dir
var checkDir = function(folder){
	var res;
	$.ajax({
	async: false,
	url: "/api/cctv/checkdir/"+folder+"/",
	type: 'GET',
	success: function(response) {
		res = response;
		console.log(response);
	},
	error: function() {
		console.log("error");
	}
	});
	return res;
}
// Start google map
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
// Add marker based on checkPing status
function marker(i){
if (i > locations.length) return;
if (i > 0) {
var infowindow = new google.maps.InfoWindow();
	var marker;
	var content;
	var iconOnline = {
		url: '{{ asset('/images/cam_on.svg') }}', // url
		scaledSize: new google.maps.Size(24, 24)
	};
	var iconOffline = {
		url: '{{ asset('/images/cam_off.svg') }}', // url
		scaledSize: new google.maps.Size(24, 24)
	}
	marker = 1;
	$content = '<h4>'+locations[i][0]+'</h4><p>IP Address: '+locations[i][3]+'</p>';
	if(checkPing(locations[i][3]) === 'online'){
		marker = new google.maps.Marker({
			position: new google.maps.LatLng(locations[i][1], locations[i][2]),
			map: map,
			icon: iconOnline,
		});
		google.maps.event.addListener(marker, 'mouseover', function(marker) {
			infowindow = new google.maps.InfoWindow({
			content: '<h4>'+locations[i][0]+'</h4><p>IP Address: '+locations[i][3]+'</p>',
			maxWidth: 200
			});
			infowindow.open(map, this);
		});
		google.maps.event.addListener(marker, 'mouseout', function(marker) {
			infowindow.close();
		});
		google.maps.event.addListener(marker, 'click', function(marker) {
			showModal(1,locations[i][3],locations[i][0]);
		});
			console.log('online '+locations[i][3])
	} else {
		marker = new google.maps.Marker({
			position: new google.maps.LatLng(locations[i][1], locations[i][2]),
			map: map,
			icon: iconOffline,
		});
		google.maps.event.addListener(marker, 'mouseover', function(marker) {
			infowindow = new google.maps.InfoWindow({
			content: '<h4>'+locations[i][0]+'</h4><p>IP Address: '+locations[i][3]+'</p>',
			maxWidth: 200
			});
			infowindow.open(map, this);
		});
		google.maps.event.addListener(marker, 'mouseout', function(marker) {
			infowindow.close();
		});
		console.log('offline '+locations[i][3])
	}
}
console.log(i);
// Bypass last iteration
if(i < locations.length - 1){
	var t=setTimeout("marker("+(i+1)+")",1000);
}
}
setTimeout(function() {
	initMap();
}, 0);
marker(0);
</script>
<script>
var countdown;
var pidCam;
function showInfo(){
	$(".gm-style-iw").css("display: block");
}
function showModal(id,ip,camName){
	var newImg = $('#imgCam');
	var nameCam = $('#camName');
	$(".modal").addClass("is-active");
	pidCam = playCam(ip);
	newImg.attr("src", '/images/ajax-loader.gif');
	nameCam.text(camName);
	dirCheck = setInterval(function(){
		if(checkDir(pidCam[1]) === 'exist'){
			clearInterval(dirCheck);
			var counter = 1;
			var date = moment(new Date());
			date = date.subtract(3, 'minutes');
			countdown = setInterval(function(){
			if (counter === 361) {
				counter = 1;
				date = date.add(1, 'minutes');
			}
			// Add time version to prevent image caching
			var filename = '/video/'+pidCam[1]+'/ip-'+counter+'.jpeg?ver='+ (new Date().getTime());
			newImg.attr("src", filename);
			console.log(filename);
			counter++;
			}, 1000/3);
		}
	}, 1000/3);
}
$(document).on('click', '.modal-close', function() {
	$(".modal").removeClass("is-active");
	clearInterval(countdown);
	stopCam(pidCam[0],pidCam[1],pidCam[2]);
	return false;
});
$(document).on('click', '.notification > button.delete', function() {
	$(this).parent().addClass('is-hidden');
	return false;
});
</script>
@endsection
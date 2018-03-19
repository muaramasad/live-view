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
				var locations = {!! json_encode($camsLocation) !!};
				var siteIp = '{{$site->url_1}}';
				var checkPing = function(ip){
					$.ajax({
					url: "/api/cctv/status/" + ip,
					type: 'GET',
					success: function(data) {
						return data;
					},
					error: function() {
						console.log("error");
					}
					});
				}
				function initMap() {
					var siteCor = {lat: {{$site->cor_x}}, lng: {{$site->cor_y}}};
			        var map = new google.maps.Map(document.getElementById('map'), {
			          zoom: 17.6,
			          center: siteCor,
			          mapTypeId: 'satellite'
			        });

			        map.setOptions({draggable: false, zoomControl: true, scrollwheel: false, disableDoubleClickZoom: true});

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
    				
					var markers = locations.map(function(location, i) {
						marker = 1;
						$content = '<h4>'+location[0]+'</h4><p>IP Address: '+location[3]+'</p>';
						if(checkPing(siteIp) === 'online' ){
							if(checkPing(location[3])){
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
						// console.log($content);
						// $.ajax({
						// url: "/api/cctv/status/" + location[3],
						// type: 'GET',
						// success: function(data) {
						// if (data === 'online') {
						// marker = new google.maps.Marker({
						// position: new google.maps.LatLng(location[1], location[2]),
						// map: map,
						// icon: iconOnline,
						// });
						// google.maps.event.addListener(marker, 'mouseover', function(marker, i) {
						// 	infowindow = new google.maps.InfoWindow({
						// 	content: '<h4>'+location[0]+'</h4><p>IP Address: '+location[3]+'</p>',
						// 	maxWidth: 200
						// 	});
						// 	infowindow.open(map, this);
						// 	});
						// google.maps.event.addListener(marker, 'mouseout', function(marker, i) {
						// 	infowindow.close();
						// 	});
						// google.maps.event.addListener(marker, 'click', function(marker, i) {
						// 	showModal(1,location[3].split('.').join(""),location[0]);
						// 	});
						// console.log('finish'+location[3])
						// } else {
						// marker = new google.maps.Marker({
						// position: new google.maps.LatLng(location[1], location[2]),
						// map: map,
						// icon: iconOffline,
						// });
						// google.maps.event.addListener(marker, 'mouseover', function(marker, i) {
						// 	infowindow = new google.maps.InfoWindow({
						// 	content: '<h4>'+location[0]+'</h4><p>IP Address: '+location[3]+'</p>',
						// 	maxWidth: 200
						// 	});
						// 	infowindow.open(map, this);
						// 	});
						// google.maps.event.addListener(marker, 'mouseout', function(marker, i) {
						// 	infowindow.close();
						// 	});
						// console.log('finish'+location[3])

						// }
						// },
						// error: function() {
						// console.log("error");
						// }
						// });
						// marker = new google.maps.Marker({
						// 	position: new google.maps.LatLng(location[1], location[2]),
				  //       	map: map,
				  //       	icon: iconOnline,
						// });
						// google.maps.event.addListener(marker, 'mouseover', function(marker, i) {
						// 	infowindow = new google.maps.InfoWindow({
      //       				content: '<h4>'+location[0]+'</h4><p>IP Address: '+location[3]+'</p>',
      //       				maxWidth: 200
      //   					});
    		// 				infowindow.open(map, this);
  				// 		});
  				// 		google.maps.event.addListener(marker, 'mouseout', function(marker, i) {
    		// 				infowindow.close();
  				// 		});
						// google.maps.event.addListener(marker, 'click', function(marker, i) {
    		// 				showModal(1,location[3].split('.').join(""),location[0]);
  				// 		});
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
		function checkStatus(){
			var siteCor = {lat: {{$site->cor_x}}, lng: {{$site->cor_y}}};
		    var map = new google.maps.Map(document.getElementById('map'), {
		          zoom: 17.8,
		          center: siteCor,
		          mapTypeId: 'satellite'
			});

			var iconOnline = {
				url: '{{ asset('/images/cam_on.svg') }}', // url
				scaledSize: new google.maps.Size(24, 24)
			};

			var iconOffline = {
				url: '{{ asset('/images/cam_off.svg') }}', // url
				scaledSize: new google.maps.Size(24, 24)
			}

			locations.map(function(location, i) {
			checkPing(location[3]);
			// $.ajax({
			// url: "/api/cctv/status/" + location[3],
			// type: 'GET',
			// success: function(data) {
			// 	if (data === 'online') {
			// 		marker = new google.maps.Marker({
			// 			position: new google.maps.LatLng(location[1], location[2]),
			// 			map: map,
			// 			icon: iconOnline,
			// 		});
			// 		new google.maps.event.addListener(marker, 'mouseover', function(marker, i) {
			// 				infowindow = new google.maps.InfoWindow({
   //          				content: '<h4>'+location[0]+'</h4><p>IP Address: '+location[3]+'</p>',
   //          				maxWidth: 200
   //      					});
   //  						infowindow.open(map, this);
  	// 					});
  	// 				new google.maps.event.addListener(marker, 'mouseout', function(marker, i) {
   //  						infowindow.close();
  	// 					});
			// 		new google.maps.event.addListener(marker, 'click', function(marker, i) {
   //  						showModal(1,location[3].split('.').join(""),location[0]);
  	// 					});
			// 		console.log('finish'+location[3])
			// 	} else {
			// 		marker = new google.maps.Marker({
			// 			position: new google.maps.LatLng(location[1], location[2]),
			// 			map: map,
			// 			icon: iconOffline,
			// 		});
			// 		new google.maps.event.addListener(marker, 'mouseover', function(marker, i) {
			// 				infowindow = new google.maps.InfoWindow({
   //          				content: '<h4>'+location[0]+'</h4><p>IP Address: '+location[3]+'</p>',
   //          				maxWidth: 200
   //      					});
   //  						infowindow.open(map, this);
  	// 					});
  	// 				new google.maps.event.addListener(marker, 'mouseout', function(marker, i) {
   //  						infowindow.close();
  	// 					});
  	// 				console.log('finish'+location[3])

			// 	}
			// },
			// error: function() {
			// console.log("error");
			// }
			// });
			});
		}
		function showInfo(){
			$(".gm-style-iw").css("display: block");
		}
		function showModal(id,path,camName){
			$(".modal").addClass("is-active");
			var counter = 1;
			var date = moment(new Date());
			date = date.subtract(3, 'minutes');
    		newYearCountdown = setInterval(function(){
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
			 clearInterval(newYearCountdown);
		     return false;
		});
		$(document).on('click', '.notification > button.delete', function() {
		    $(this).parent().addClass('is-hidden');
		    return false;
		});
		// setTimeout(function() {
		// 	checkStatus();
		// }, 100);
		</script>
@endsection
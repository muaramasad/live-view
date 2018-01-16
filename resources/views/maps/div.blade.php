@extends('layouts.app')
@section('content')
{{ Breadcrumbs::render('map', $division) }}
<div class="columns">
	<div class="column">
		<div class="card">
			<header class="card-header">
				<p class="card-header-title">
					{{$division->division_name}}
				</p>
			</header>
			<div class="card-content">
				<div class="field is-grouped is-grouped-multiline">
					<p class="control">
						<button class="btn-all button is-small">
							All Sites
						</button>
					</p>
					@foreach($areas as $area)
					<p class="control">
						<button class="btn-area button is-small" data-id="{{$area->id}}">
							{{$area->area_name}}
						</button>
					</p>
					@endforeach
				</div>
				<div class="map">
					<div id="mapdiv" style="width: 100%; height: 600px;"></div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
var options = {
    type: "map",
    balloon: {
        color: "#000000",
        horizontalPadding: 15,
        verticalPadding: 15,
        cornerRadius: 5
    },
    dataProvider: {
        map: "indonesiaLow",
        getAreasFromMap: true,
        zoomLevel: 0.9,
        images: []
    },
    areasSettings: {
        autoZoom: true,
        color: "#f39c12",
        selectedColor: "#e67e22",
        rollOverOutlineColor: "#e67e22",
        balloonText: "[[title]]",
    },
    zoomControl: {
        minZoomLevel: 0.9,
        homeButtonEnabled: true,
        zoomControlEnabled: true
    },
    };
var map = AmCharts.makeChart("mapdiv", options);
$(".btn-all").click(function(e) {
	var url = "/api/division/" + {{ $division->id }};
	$.ajax({
        type: "GET",
        url: url,
        success: function(data) {
        	var images = [];
	        for (var i = 0; i < data.length; i++) {
	            images.push({
	                "latitude": data[i].cor_x,
	                "longitude": data[i].cor_y,
	                "imageURL": "{{ asset('images/security-system.png') }}",
	                "width": 16,
	                "height": 16,
	                "label": data[i].site_name,
	                "title": data[i].site_name,
	                "description": "URL Link 1 = <a href='" + data[i].url_1 + "'>View CCTV</a><br/>URL Link 2 = <a href='" + data[i].url_2 + "'>View CCTV</a> "
	            });
	        }
        	console.log(images);
	        map.dataProvider.images = images;
        	map.validateData();
    	},
	    error: function() {
	        console.log("error");
	    }
    });
});

$(".btn-area").click(function(e) {
	var areaId = $(this).attr("data-id");
    e.preventDefault();
    var url = "/api/division/" + {{ $division->id }} + "/" + areaId;
	e.preventDefault();
	$.ajax({
        type: "GET",
        url: url,
        success: function(data) {
        	var images = [];
	        for (var i = 0; i < data.length; i++) {
	            images.push({
	                "latitude": data[i].cor_x,
	                "longitude": data[i].cor_y,
	                "imageURL": "{{ asset('images/security-system.png') }}",
	                "width": 16,
	                "height": 16,
	                "label": data[i].site_name,
	                "title": data[i].site_name,
	                "description": "URL Link 1 = <a href='" + data[i].url_1 + "'>View CCTV</a><br/>URL Link 2 = <a href='" + data[i].url_2 + "'>View CCTV</a> "
	            });
	        }
	        console.log(images);
	        map.dataProvider.images = images;
        	map.validateData();
    	},
	    error: function() {
	        console.log("error");
	    }
    });
});
</script>
@endsection
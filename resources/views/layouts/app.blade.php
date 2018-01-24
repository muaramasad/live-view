<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Japfa CCTV Monitoring System</title>
		<link rel="stylesheet" href="{{ asset('css/app.css') }}">
		{{-- <link rel="stylesheet" href="{{ asset('ammap/ammap.css') }}">
		<script type="text/javascript" src="{{ asset('ammap/ammap.js') }}"></script>
		<script type="text/javascript" src="{{ asset('ammap/maps/js/indonesiaLow.js') }}"></script> --}}
		<script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
		<link href="https://unpkg.com/video.js/dist/video-js.css" rel="stylesheet">
		<script src="https://unpkg.com/video.js/dist/video.js"></script>
		<script src="https://unpkg.com/videojs-contrib-hls/dist/videojs-contrib-hls.js"></script>
	</head>
	<body>
		<div id="app">
			<nav class="navbar" role="navigation" aria-label="main navigation">
				<div class="navbar-brand">
					<a class="navbar-item" href="{{route('homepage')}}">
						<strong>Japfa CCTV Monitoring System</strong>
					</a>
					<button class="button navbar-burger">
					<span></span>
					<span></span>
					<span></span>
					</button>
				</div>
				<div class="navbar-menu">
					<div class="navbar-start">
						<a href="{{route('division.index')}}" class="navbar-item">
							Divisions
						</a>
						<a href="{{route('area.index')}}" class="navbar-item">
							Areas
						</a>
						<a href="{{route('site.index')}}" class="navbar-item">
							Sites
						</a>
						<a href="{{route('cam.index')}}" class="navbar-item">
							CCTV
						</a>
					</div>
				</div>
			</nav>
			<section class="section is-paddingless m-t-lg">
				<div class="container">
					@include('layouts.errors')
					@include('layouts.notifications')
					@yield('content')
				</div>
			</section>
			
		</div>
		{!! Mapper::renderJavascript() !!}
		<script>
		function showModal(){
		    $(".modal").addClass("is-active");
		}
		$(document).on('click', '.modal-close', function() {
		     $(".modal").removeClass("is-active");
		     return false;
		});
		$(document).on('click', '.notification > button.delete', function() {
		    $(this).parent().addClass('is-hidden');
		    return false;
		});
		</script>
	</body>
</html>
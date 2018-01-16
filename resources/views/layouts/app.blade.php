<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Japfa CCTV Monitoring System</title>
		<link rel="stylesheet" href="{{ asset('css/app.css') }}">
		<link rel="stylesheet" href="{{ asset('ammap/ammap.css') }}">
		<script type="text/javascript" src="{{ asset('ammap/ammap.js') }}"></script>
		<script type="text/javascript" src="{{ asset('ammap/maps/js/indonesiaLow.js') }}"></script>
		<script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
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
					</div>
				</div>
			</nav>
			<section class="section is-paddingless m-t-lg">
				<div class="container">
					@yield('content')
				</div>
			</section>
		</div>
	</body>
</html>
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
		<script type="text/javascript" src="{{ asset('js/moment.js') }}"></script>
		<script src="https://unpkg.com/videojs-contrib-hls/dist/videojs-contrib-hls.js"></script>
	</head>
	<body>
		<div id="app">
			<nav class="navbar" role="navigation" aria-label="main navigation">
				<div class="navbar-brand">
					<a class="navbar-item" href="{{route('homepage')}}">
						{{-- <img src="{{ asset('images/japfa_logo.png')}}" alt="Japfa Monitoring System" width="auto" height="28"> --}}
					</a>
					<button class="button navbar-burger">
					<span></span>
					<span></span>
					<span></span>
					</button>
				</div>
				<div class="navbar-menu">
					<div class="navbar-start">
						@guest

						@else
						@if(Auth::user()->id == 1)
						<a href="{{route('division.index')}}" class="navbar-item">
							Divisions
						</a>
						<a href="{{route('area.index')}}" class="navbar-item">
							Areas
						</a>
						<a href="{{route('site.index')}}" class="navbar-item">
							Sites
						</a>
						<a href="{{route('user.index')}}" class="navbar-item">
							Users
						</a>
						<a href="{{route('role.index')}}" class="navbar-item">
							Roles
						</a>
						<a href="{{route('permission.index')}}" class="navbar-item">
							Permissions
						</a>
						@endif
						@endguest
					</div>
					<div class="navbar-end">
					@guest
					<a href="{{ route('login') }}" class="navbar-item">
							Login
						</a>
					@else
					<div class="navbar-item has-dropdown is-hoverable">
        				<a class="navbar-link" href="#">
						Hi, {{ Auth::user()->name }}
        				</a>
						<div class="navbar-dropdown is-boxed">
							<a class="navbar-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
            					Logout
          					</a>
							<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                            </form>
						</a>
					</div>
					@endguest
				</div>
			</nav>
			<section class="section is-paddingless m-t-lg">
				<div class="container is-fluid">
					@include('layouts.errors')
					@include('layouts.notifications')
					@yield('content')
				</div>
			</section>
		</div>
		<script>
		function readURL(input) {
			if (input.files && input.files[0]) {
				var reader = new FileReader();
				reader.onload = function (e) {
					$('#blah').attr('src', e.target.result);
				};
				reader.readAsDataURL(input.files[0]);
			}
		}
		</script>
	</body>
</html>
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
				<div class="map">
					<div id="mapdiv" style="width: 100%; height: 600px;">
						{!! Mapper::render() !!}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="modal">
	<div class="modal-background"></div>
	<div class="modal-content">
		<img id="test">
	</div>
	<button class="modal-close is-large" aria-label="close"></button>
</div>
@endsection
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
				{{-- 				<div class="field is-grouped is-grouped-multiline">
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
				<div class="map">
					<div id="mapdiv" style="width: 100%; height: 600px;">
						{!! Mapper::render() !!}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
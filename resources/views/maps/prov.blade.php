@extends('layouts.app')
@section('content')
{{ Breadcrumbs::render('prov', $division,$prov) }}
<div class="columns">
	<div class="column">
		<div class="card">
			<header class="card-header">
				<p class="card-header-title">
					{{$prov->province_name}}
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
@endsection